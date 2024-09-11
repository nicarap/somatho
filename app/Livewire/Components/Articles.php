<?php

namespace App\Livewire\Components;

use App\Models\Article;
use App\Models\Tag;
use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class Articles extends Component
{
    public $empty_new_articles = false;
    private $skip = 0;
    private $get = 0;
    public $filters = [];
    public $tags;

    public $articles;

    protected $listeners = ["getNextArticles"];

    public function mount()
    {
        $this->articles = collect([]);
        $this->tags = Tag::all();
        $this->filters = [
            "tags" => $this->tags->pluck("id"),
        ];
    }

    public function getNextArticles(): Collection
    {
        // TODO : To optimize

        // Get 8 first articles and then, 8 more when scroll 
        $this->get += 8;
        $query = Article::published()->orderBy('published_at')->limit($this->get);

        if ($tags = Arr::get($this->filters, "tags")) {
            $query->whereHas('tags', fn ($q) => $q->whereIn("tags.id", $tags));
        }

        $this->articles = $query->get();

        if ($this->articles->count() <= 0) {
            $this->empty_new_articles = true;
        } else {
            $this->skip += $this->get;
        }

        return $this->articles;
    }

    public function search()
    {
        if ($tags = Arr::get($this->filters, "tags")) {
            dd($this->articles->whereHas("tags", fn ($query) => $query->whereIn("tags.in", $tags)));
            return $this->articles->whereHas("tags", fn ($query) => $query->whereIn("tags.in", $tags));
        }
    }

    public function render()
    {
        return view('livewire.components.articles', [
            "articles" => $this->getNextArticles(),
        ]);
    }
}
