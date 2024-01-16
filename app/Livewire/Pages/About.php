<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class About extends Component
{
    public array $meta;

    public function mount()
    {
        $this->meta = [
            "title" => "A propos de moi - Amélie Bonzi",
            "description" => "Je suis Amélie Bonzi, somatothérapeute dévouée à votre bien-être. Je vous dévoile mon parcours, ma philosophie et ma mission en tant que practicienne de la somatopathie. Découvrez comment mon expertise en mouvement, respiration et conscience corporelle contribue à votre bien-être. Bienvenue dans mon espace dédié à l'harmonie physique et mentale.",
        ];
    }

    public function render()
    {
        return view('livewire.pages.about')
            ->layout('components.layouts.app', $this->meta);
    }
}
