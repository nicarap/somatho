<?php

namespace App\Livewire\Pages;

use App\Models\Article as Model;
use Livewire\Component;

class Article extends Component
{
    public array $meta;
    public Model $article;

    public function mount(Model $article)
    {
        $this->article = $article;
        $this->meta = [
            "title" => "{$article->title} - Amélie Bonzi",
            "description" => $article->description ?? null,
            "image" => $article->image
        ];
    }

    public function render()
    {
        return view('livewire.pages.article')
            ->layout('components.layouts.app', $this->meta);
    }
}
