<?php

namespace App\Livewire;

use App\Models\Review;
use Illuminate\Support\Collection;
use Livewire\Component;

class Reviews extends Component
{
    public Collection $reviews;
    public int $offset = 0;
    public int $limit = 3;

    public function mount()
    {
        $this->loadReviews();
    }

    public function loadReviews()
    {
        // Récupère 3 avis aléatoirement
        $this->reviews = Review::inRandomOrder()
            ->limit($this->limit)
            ->get();

        $this->hasNext = Review::offset($this->offset + $this->limit)->exists();
        $this->hasPrev = $this->offset > 0;
    }

    public function render()
    {
        return view('livewire.reviews');
    }
}
