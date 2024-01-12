<?php

namespace App\Livewire\Article;

use App\Models\Article;
use Livewire\Component;
use Illuminate\Support\Collection;

class ArticleList extends Component
{
    public $articles;

    public function mount(Collection $articles)
    {
        $this->articles = $articles;
    }

    public function navigateTo(Article $article)
    {
        return redirect(route('article.view', ["article" => $article]));
    }

    public function render()
    {
        return view('livewire.article.article-list');
    }
}
