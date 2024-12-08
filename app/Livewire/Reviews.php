<?php

namespace App\Livewire;

use App\Models\Review;
use Illuminate\Support\Collection;
use Livewire\Component;

class Reviews extends Component
{
    public Collection $reviews;
    public int $offset = 0;
    public int $limit = 2;
    public bool $hasNext = true;
    public bool $hasPrev = false;

    public function mount()
    {
        $this->loadReviews();
    }

    public function loadReviews()
    {
        $this->reviews = Review::latest()
            ->offset($this->offset)
            ->limit($this->limit)
            ->get();

        $this->hasNext = Review::offset($this->offset + $this->limit)->exists();
        $this->hasPrev = $this->offset > 0;
    }

    public function next()
    {
        // Avance de $limit avis
        $this->offset += $this->limit;
        $this->loadReviews();
    }

    public function prev()
    {
        // Recule de $limit avis
        $this->offset = max(0, $this->offset - $this->limit);
        $this->loadReviews();
    }

    public function render()
    {
        return view('livewire.reviews');
    }
}
