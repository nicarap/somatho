<?php

namespace App\Livewire\Pages;

use App\Models\Article;
use App\Models\Review;
use Livewire\Component;
use Illuminate\Support\Arr;

class Home extends Component
{
    public array $meta;
    public bool $hasReviews;
    public bool $hasArticles;

    public function mount()
    {
        $this->hasReviews = Review::count() > 0;
        $this->hasArticles = Article::count() > 0;
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
