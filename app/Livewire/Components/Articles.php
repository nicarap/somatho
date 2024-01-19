<?php

namespace App\Livewire\Components;

use App\Models\Article;
use Livewire\Component;

class Articles extends Component
{
    public $articles;
    public $empty_new_articles = false;
    private $skip = 0;
    private $get = 1;

    protected $listeners = ["getNextArticles"];

    public function mount()
    {
        $this->articles = Article::published()->orderBy('published_at')->limit($this->get)->get();
    }

    public function getNextArticles()
    {
        $skip = $this->get + $this->skip;

        $new_articles = Article::published()->orderBy('published_at')->skip($skip)->limit($this->get)->get();

        if($new_articles->count() > 0){
            $this->skip = $skip;

            $this->articles = $this->articles->merge($new_articles);  
        }else $this->empty_new_articles = true;
    }
    
    public function render()
    {
        return view('livewire.components.articles');
    }
}
