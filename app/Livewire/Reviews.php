<?php

namespace App\Livewire;

use App\Models\Review;
use Illuminate\Support\Collection;
use Livewire\Component;

class Reviews extends Component
{
    public Collection $reviews;

    public function mount()
    {
        $this->reviews = Review::limit(3)->get();
    }

    public function render()
    {
        return view('livewire.reviews');
    }
}
