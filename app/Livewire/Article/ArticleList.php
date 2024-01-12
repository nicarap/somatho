<?php

namespace App\Livewire\Article;

use App\Models\Article;
use Livewire\Component;

class ArticleList extends Component
{
    public $articles;

    public function mount()
    {
        $this->articles = Article::published()->orderBy("published_at")->get();
    }

    public function navigateTo(Article $article)
    {
        dd($article);
        return redirect(route('article.view', ["article" => $article]));
    }

    public function render()
    {
        return view('livewire.article.article-list');
    }
}
