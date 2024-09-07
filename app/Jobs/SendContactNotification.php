<?php

namespace App\Jobs;

use App\Models\Contact;
use App\Models\Therapist;
use App\Notifications\ContactNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendContactNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected Contact $contact)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $therapist = Therapist::first();
        $therapist->notify(new ContactNotification($this->contact));
    }
}
