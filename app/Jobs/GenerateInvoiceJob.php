<?php

namespace App\Jobs;

use Exception;
use Carbon\Carbon;
use App\Models\Traitment;
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
use Illuminate\Contracts\Queue\ShouldBeUnique;

class GenerateInvoiceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Traitment $traitment)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(InvoiceService $invoiceService): void
    {
        DB::beginTransaction();
        try {
            $invoice = $invoiceService->create([
                "programmed_start_at" => $this->traitment->programmed_start_at,
                "paid_at" => $this->traitment->programmed_start_at,
                "traitment_id" => $this->traitment->id,
                "therapist_street" => $this->traitment->therapist->addresses()->firstWhere("default", true)->street,
                "therapist_context" => $this->traitment->therapist->addresses()->firstWhere("default", true)->context,
                "therapist_postcode" => $this->traitment->therapist->addresses()->firstWhere("default", true)->postcode,
                "therapist_city" => $this->traitment->therapist->addresses()->firstWhere("default", true)->city,
                "patient_street" => $this->traitment->patient->address->street,
                "patient_context" => $this->traitment->patient->address->context,
                "patient_postcode" => $this->traitment->patient->address->postcode,
                "patient_city" => $this->traitment->patient->address->city,
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }


        $pdf = Pdf::loadView('pdf.invoice', ["invoice" => $invoice]);
        $output = $pdf->output();
        $filepath = config("app.invoice_folder") . DIRECTORY_SEPARATOR . Str::slug($this->traitment->patient->name);
        $filename = "Invoice_{$invoice->number}_" . Carbon::parse($this->traitment->programmed_start_at)->format("Ymd_Hi") . ".pdf";
        $file = $filepath . DIRECTORY_SEPARATOR . $filename;

        $invoice->update(["filename" => $filename]);
        $invoice->traitment()->associate($this->traitment)->save();

        Storage::put($file, $output);

        Notification::send($this->traitment->patient, new SendInvoiceNotification($invoice));
    }
}
