<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;

class Articles extends Component
{
    public $articles;

    public function __construct()
    {
        $this->articles = Article::published()->orderBy('published_at')->limit(4)->get();
    }

    public function render()
    {
        return view('livewire.articles');
    }
}
