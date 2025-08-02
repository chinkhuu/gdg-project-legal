<?php

namespace App\Livewire;

use App\Models\Attorney;
use App\Models\Segment;
use Livewire\Component;

class Lawyers extends Component
{
    public $lawyers;
    public $segments;
    public $selectedSegment = null;
    public $search = '';

    public function mount()
    {
        $this->segments = Segment::all();
        $this->filterLawyers();
    }

    public function updatedSelectedSegment()
    {
        $this->filterLawyers();
    }

    public function updatedSearch()
    {
        $this->filterLawyers();
    }

    protected function filterLawyers()
    {
        $query = Attorney::with('segment');

        if (!empty($this->selectedSegment)) {
            $query->where('segment_id', $this->selectedSegment);
        }

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $this->lawyers = $query->get();
    }

    public function render()
    {
        return view('livewire.lawyers')->layout('layouts.app');
    }
}
