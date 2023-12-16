<?php

namespace App\Livewire;

use App\Models\Therapist;
use App\Notifications\ContactNotification;
use Exception;
use Livewire\Component;

class Contact extends Component
{
    public string $name = "";
    public string $email = "";
    public string $tel = "";
    public string $message = "";

    public bool $message_sended_successfull = false;
    public bool $message_sended_error = false;

    public function submit()
    {

        try {
            $therapist = Therapist::first();

            $therapist->notify(new ContactNotification([
                "name" => $this->name,
                "email" => $this->email,
                "message" => $this->message,
            ]));

            $this->message_sended_successfull = true;
        } catch (Exception $e) {
            $this->message_sended_error = true;
            report($e);
        }
    }

    public function render()
    {
        return view('livewire.contact');
    }
}
