<?php

namespace App\Jobs;

use App\Models\Therapist;
use Exception;
use Carbon\Carbon;
use App\Models\Traitment;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\InvoiceService;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendInvoiceNotification;
use phpDocumentor\Reflection\Types\Boolean;

class GenerateInvoiceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Therapist $therapist, public User $patient, public Carbon $date, public bool $send_patient = true) {}

    /**
     * Execute the job.
     */
    public function handle(InvoiceService $invoiceService): void
    {
        DB::beginTransaction();

        try {
            $invoice = $invoiceService->create($this->therapist, $this->patient, $this->date);

            $pdf = Pdf::loadView('pdf.invoice', ["invoice" => $invoice]);
            $output = $pdf->output();
            $filepath = config("app.invoice_folder") . DIRECTORY_SEPARATOR . Str::slug($this->patient->name);
            $filename = "Invoice_{$invoice->number}_" . $this->date->format("Ym") . ".pdf";
            $file = $filepath . DIRECTORY_SEPARATOR . $filename;

            $invoice->update(["filename" => $filename]);

            Storage::put($file, $output);

            $destinataires = array_merge($this->patient->hasEmail() && $this->send_patient ? [$this->patient] : [], [$this->therapist]);

            Notification::send($destinataires, new SendInvoiceNotification($invoice));

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
