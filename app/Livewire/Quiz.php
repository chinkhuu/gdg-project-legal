<?php

namespace App\Livewire;

use Livewire\Component;

class Quiz extends Component
{
    public \App\Models\Quiz $quiz;
    public array $questions = [];
    public int $currentIndex = 0;
    public ?int $selectedAnswer = null;
    public int $score = 0;
    public bool $completed = false;

    /**
     * @param  string  $slug
     */
    public function mount(string $slug)
    {
        $this->quiz = \App\Models\Quiz::with('questions.answers')
            ->where('slug', $slug)
            ->firstOrFail();

        $this->questions = $this->quiz->questions->toArray();
    }

    public function submitAnswer()
    {
        if (is_null($this->selectedAnswer)) {
            return;
        }

        $current = $this->questions[$this->currentIndex];
        $answer = collect($current['answers'])
            ->firstWhere('id', $this->selectedAnswer);

        if ($answer && $answer['is_correct']) {
            $this->score++;
        }

        if ($this->currentIndex + 1 < count($this->questions)) {
            $this->currentIndex++;
            $this->selectedAnswer = null;
        } else {
            $this->completed = true;
        }
    }


    public function render()
    {
        return view('livewire.quiz')->layout('layouts.app');
    }
}
