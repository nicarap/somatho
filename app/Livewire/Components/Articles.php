<?php

namespace App\Livewire\Components;

use App\Models\Article;
use App\Models\Tag;
use Livewire\Component;
use Illuminate\Support\Arr;

class Articles extends Component
{
    public $empty_new_articles = false;
    private $skip = 0;
    private $get = 1;
    public $filters = [];
    public $tags;

    protected $listeners = ["getNextArticles"];

    public function mount()
    {
        $this->tags = Tag::all();
        $this->filters = [
            "tags" => $this->tags->pluck("id"),
        ];
    }

    public function getNextArticles()
    {
        $skip = $this->get + $this->skip;

        $new_articles = Article::published()->orderBy('published_at')->skip($skip)->limit($this->get)->get();

        if ($new_articles->count() <= 0) {
            $this->empty_new_articles = true;
        }
    }

    public function search()
    {
        if ($tags = Arr::get($this->filters, "tags")) {
            return Article::published()->orderBy('published_at')->limit($this->get)->whereHas("tags", fn($query) => $query->whereIn("tags.in", $tags));
        }
    }

    public function render()
    {
        $query = Article::published()->orderBy('published_at')->skip($this->skip)->with('tags')->limit($this->get);

        if ($tags = Arr::get($this->filters, "tags")) {
            $query->whereHas('tags', fn($q) => $q->whereIn("tags.id", $tags));
        }

        return view('livewire.components.articles', [
            "articles" => $query->get()
        ]);
    }
}
