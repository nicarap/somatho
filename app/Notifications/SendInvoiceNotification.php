<?php

namespace App\Notifications;

use Carbon\Carbon;
use App\Models\Invoice;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendInvoiceNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Invoice $invoice)
    {
        $this->afterCommit();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $filepath = Storage::path(config("app.invoice_folder") . DIRECTORY_SEPARATOR . Str::slug($this->invoice->traitment->patient->name));
        $date = Carbon::parse($this->invoice->traitment->realized_at)->format("d/m/Y à H:i");

        return (new MailMessage)
            ->view("mail.send_invoice", ["invoice" => $this->invoice])
            ->attach($filepath . DIRECTORY_SEPARATOR . $this->invoice->filename);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
