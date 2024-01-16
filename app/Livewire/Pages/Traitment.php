<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Traitment extends Component
{
    public array $meta;

    public function mount()
    {
        $this->meta = [
            "title" => "La somatopathie - Amélie Bonzi",
            "description" => "Découvrez la consultation en somatopathie : de la première rencontre à l'harmonisation corporelle. Tarifs transparents, expertise centrée sur le mouvement et la respiration. Transformez votre bien-être dès aujourd'hui.",
        ];
    }

    public function render()
    {
        return view('livewire.pages.traitment')
            ->layout('components.layouts.app', $this->meta);
    }
}
