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
    public $pinnedArticles;

    protected $listeners = ["getNextArticles"];

    public function mount()
    {
        $this->pinnedArticles = $this->getPinnedArticles();
        $this->articles = collect([]);
        $this->tags = Tag::all();
        $this->filters = [
            "tags" => $this->tags->pluck("id"),
        ];

        $this->getNextArticles();
    }

    public function getNextArticles()
    {
        // Reset the articles collection if it's the first load
        if ($this->get === 0) {
            $this->skip = 0;
            $this->articles = collect([]);
        }

        // Get 8 first articles and then, 8 more when scroll 
        $this->get += 8;
        $query = Article::published()->orderBy('published_at', 'desc')->skip($this->skip)->limit($this->get);

        if ($tags = Arr::get($this->filters, "tags")) {
            $query->where(function ($q) use ($tags) {
                $q->whereHas('tags', fn($q) => $q->whereIn("tags.id", $tags))
                    ->orWhereDoesntHave('tags');
            });
        }

        $new_articles = $query->get();

        if ($new_articles->count() <= 0) {
            $this->empty_new_articles = true;
        } else {
            $this->empty_new_articles = false;
            $this->skip += $this->get;
        }
        $this->articles = $this->articles->merge($new_articles);
    }

    public function search()
    {
        if ($tags = Arr::get($this->filters, "tags")) {
            return $this->articles->whereHas("tags", fn($query) => $query->whereIn("tags.in", $tags));
        }
    }

    public function getPinnedArticles()
    {
        return Article::isPinned()->get();
    }

    public function render()
    {
        return view('livewire.components.articles', [
            "articles" => $this->articles,
            "pinnedArticles" => $this->pinnedArticles,
            "empty_new_articles" => $this->empty_new_articles,
        ]);
    }
}
