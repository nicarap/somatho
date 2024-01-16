<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Articles extends Component
{
    public array $meta;

    public function mount()
    {
        $this->meta = [
            "title" => "Mes articles - Amélie Bonzi",
            "description" => "Découvrez le processus complet d'une consultation en somatopathie. De la première rencontre à l'harmonisation corporelle, préparez-vous à une expérience personnalisée, axée sur le mouvement, la respiration et la conscience corporelle.",
        ];
    }

    public function render()
    {
        return view('livewire.pages.articles')
            ->layout('components.layouts.app', $this->meta);
    }
}
