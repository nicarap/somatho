<?php

namespace App\Livewire\Components;

use App\Models\Article;
use Livewire\Component;

class ArticlePreview extends Component
{
    public Article $article;

    public function mount(Article $article)
    {
        $this->article = $article;
    }
    
    public function render()
    {
        return view('livewire.components.article-preview');
    }
}
