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
        // If we don’t already have one, hit the API and store it
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

        // At this point we're guaranteed the session has a non-null, non-empty string
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

        // Run үүсгэж, streaming=true параметр явуулна (Assistant API-д үүнийг дэмжиж байвал)
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

        // Бүх chunk-уудыг уншин гаргах
        while (! $body->eof()) {
            $chunk = $body->read(1024);
            $onChunk($chunk);
        }
    }


}
