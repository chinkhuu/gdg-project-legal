<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AssistantService
{
    protected string $apiKey;
    protected string $assistantId;
    protected string $base = 'https://api.openai.com/v1';

    public function __construct()
    {
        $this->apiKey = config('services.openai.api_key');
        $this->assistantId = config('services.openai.assistant_id');
    }

    public function getOrCreateThread(): string
    {
        if (! Session::has('openai_thread_id')) {
            $response = Http::withToken($this->apiKey)
                ->post("{$this->base}/assistants/{$this->assistantId}/threads", [
                    'role'    => 'user',
                    'content' => '…whatever…',
                ]);

            $threadId = $response->json('id');

            if (! is_string($threadId) || $threadId === '') {
                throw new \RuntimeException('OpenAI did not return a thread ID');
            }

            Session::put('openai_thread_id', $threadId);
        }

        return Session::get('openai_thread_id');
    }


    public function streamMessages(string $userMessage, callable $onChunk): void
    {
        $threadId = $this->getOrCreateThread();

        Http::withToken($this->apiKey)
            ->post("{$this->base}/assistants/{$this->assistantId}/threads/{$threadId}/messages", [
                'role'    => 'user',
                'content' => $userMessage,
            ]);

        $psr = (new \GuzzleHttp\Client())
            ->request('POST', "{$this->base}/assistants/{$this->assistantId}/threads/{$threadId}/runs", [
                'headers' => [
                    'Authorization' => "Bearer {$this->apiKey}",
                    'Content-Type'  => 'application/json',
                ],
                'json'    => ['stream' => true],
                'stream'  => true,
            ]);

        $body = $psr->getBody();

        while (! $body->eof()) {
            $chunk = $body->read(1024);
            $onChunk($chunk);
        }
    }


}
