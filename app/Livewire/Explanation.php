<?php

namespace App\Livewire;

use App\Models\Segment;
use Livewire\Component;

class Explanation extends Component
{

    public $explanations;

    public function mount()
    {
        $this->explanations = \App\Models\Explanation::all();
    }

    public function render()
    {
        return view('livewire.explanation')->layout('layouts.app');
    }
}
