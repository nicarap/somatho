<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Tags extends Component
{
    public $tags;
    
    public function mount($tags)
    {
        $this->tags = $tags;
    }

    public function render()
    {
        return view('livewire.components.tags');
    }
}
