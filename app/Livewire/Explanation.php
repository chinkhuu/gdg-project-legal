<?php

namespace App\Livewire;

use App\Models\Segment;
use Livewire\Component;

class Explanation extends Component
{

    public $search = '';

    public function render()
    {
        $explanations = \App\Models\Explanation::query()
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->get();

        return view('livewire.explanation', [
            'explanations' => $explanations,
        ])->layout('layouts.app');
    }
}
