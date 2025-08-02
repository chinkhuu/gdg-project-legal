<?php

namespace App\Livewire;

use App\Services\GeminiService;
use Livewire\Component;

class Chat extends Component
{
    public string $question = '';
    public array $messages = [];
    public bool $loading = false;

    public function mount()
    {
        $this->messages = [
            ['sender' => 'ai', 'text' => 'Сайн байна уу! Асуултаа бичээд илгээнэ үү.']
        ];
    }

    public function send(GeminiService $gemini)
    {
        $text = trim($this->question);
        if ($text === '') {
            return;
        }

        $this->messages[] = [
            'sender' => 'user',
            'text' => $text,
        ];

        $this->loading = true;
        $this->question = '';

        try {
            $answer = $gemini->ask($text);
        } catch (\Throwable $e) {
            $answer = 'Уучлаарай, холболт алдаа гарлаа.';
        }

        $this->messages[] = [
            'sender' => 'ai',
            'text' => $answer,
        ];

        $this->loading = false;

        $this->dispatch('scroll-to-bottom');
    }

    public function render()
    {
        return view('livewire.chat')->layout('layouts.app');
    }
}
