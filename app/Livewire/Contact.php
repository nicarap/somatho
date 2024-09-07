<?php

namespace App\Livewire;

use App\Jobs\SendContactNotification;
use Exception;
use Livewire\Component;
use App\Models\Therapist;
use App\Models\Contact as ContactModel;
use Illuminate\Support\Facades\Http;
use App\Notifications\ContactNotification;

class Contact extends Component
{
    public string $name = "";
    public string $email = "";
    public string $tel = "";
    public string $message = "";

    public bool $message_sended_successfull = false;
    public bool $message_sended_error = false;
    public bool $message_captcha_error = false;
    public $captcha = 0;

    public function updatedCaptcha($token)
    {
        $response = Http::post('https://www.google.com/recaptcha/api/siteverify?secret=' . env('CAPTCHA_SECRET_KEY') . '&response=' . $token);
        $this->captcha = $response->json()['score'];

        if (!$this->captcha > .3) {
            $this->submit();
        } else {
            $this->message_captcha_error = true;
        }
    }

    public function submit()
    {
        $this->message_captcha_error = false;
        try {
            $contact = new ContactModel([
                "name" => $this->name,
                "email" => $this->email,
                "tel" => $this->tel,
                "message" => $this->message,
            ]);
            $contact->save();

            SendContactNotification::dispatch($contact);

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
