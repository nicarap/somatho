<?php

namespace App\Filament\Actions;

use App\Jobs\GenerateInvoiceJob;
use App\Services\InvoiceService;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Filament\Actions\Action;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Forms\Components\DatePicker;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use App\Models\Invoice;
use App\Notifications\SendInvoiceNotification;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Notification as FacadesNotification;

class SendInvoiceAction extends Action
{
    use CanCustomizeProcess;

    public static function getDefaultName(): ?string
    {
        return __("filament.resources.traitment.actions.send_invoice.label");
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('filament.resources.traitment.actions.send_invoice.label'));

        $this->requiresConfirmation();

        $this->modalHeading(fn (): string => __('filament.resources.traitment.actions.send_invoice.modal.heading', ['patient' => $this->record->patient->name]));

        $this->modalDescription(fn (): string => __('filament.resources.traitment.actions.send_invoice.modal.description', ['date' => Carbon::parse($this->record->programmed_start_at)->format("d/m/Y H:i")]));

        $this->modalSubmitActionLabel(__('filament.resources.traitment.actions.send_invoice.cta'));

        $this->successNotification(
            Notification::make()
                ->title(__('filament.resources.traitment.actions.send_invoice.notifications.invoice_sended.success.title'))
                ->body(__('filament.resources.traitment.actions.send_invoice.notifications.invoice_sended.success.description'))
                ->success()
        );

        $this->groupedIcon('heroicon-m-pencil-square');

        $this->action(function (): void {
            $this->process(function (Model $record) {
                if (!$record->invoice) {
                    GenerateInvoiceJob::dispatch($record)->onQueue("invoice");
                } else {
                    FacadesNotification::send([$this->record->patient], new SendInvoiceNotification($this->record->invoice));
                }
            });

            $this->success();
        });
    }
}
