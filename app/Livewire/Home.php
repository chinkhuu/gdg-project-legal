<?php

namespace App\Livewire;

use App\Models\Attorney;
use Livewire\Component;

class Home extends Component
{
    public $lawyers;

    public function mount()
    {
        $this->lawyers = Attorney::with('segment')->get();
    }

    public function render()
    {
        return view('livewire.home');
    }
}
