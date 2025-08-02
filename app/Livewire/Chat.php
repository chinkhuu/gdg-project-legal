<?php

namespace App\Livewire;

use App\Services\GeminiService;
use League\CommonMark\CommonMarkConverter;
use Livewire\Component;

class Chat extends Component
{
    public string $question = '';
    public array $messages = [];
    public bool $loading = false;

    public function mount()
    {
        $this->messages = [
            ['sender' => 'ai', 'text' => 'Сайн байна уу! Танд юугаар туслах вэ?']
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

        $this->dispatch('scroll-to-bottom');
        $this->loading = true;
        $this->question = '';

        try {
            $rawAnswer = $gemini->ask($text);
            $converter = new CommonMarkConverter();
            $answer = $converter->convert($rawAnswer)->getContent();

        } catch (\Throwable $e) {
            $answer = '<p>Уучлаарай, холболтын алдаа гарлаа. Та дараа дахин оролдоно уу.</p>';
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
