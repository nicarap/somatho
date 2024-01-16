<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Arr;

class Home extends Component
{
    public array $meta;

    public function mount()
    {
        $this->meta = [
            "title" => "Amélie Bonzi - Thérapeute en somatopathie",
            "description" => "Amélie Bonzi, somatothérapeute dévouée à votre bien-être. Découvrez les bienfaits de la somatopathie pour une vie équilibrée et harmonieuse.",
        ];
    }

    public function render()
    {
        return view('livewire.pages.home')
            ->layout('components.layouts.app', $this->meta);
    }
}
