<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Somatopathy extends Component
{
    public array $meta;

    public function mount()
    {
        $this->meta = [
            "title" => "La somatopathie - Amélie Bonzi",
            "description" => "Explorez les divers domaines d'application de la somatopathie, le public concerné, et les moments propices pour consulter. Plongez dans la méthode POYET avec laquelle je travail, centrée sur l'harmonie physique et mentale.",
        ];
    }

    public function render()
    {
        return view('livewire.pages.somatopathy')
            ->layout('components.layouts.app', $this->meta);
    }
}
