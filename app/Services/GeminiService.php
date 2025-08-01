<?php

namespace App\Services;
use Gemini\Laravel\Facades\Gemini;
use Gemini\Data\Content;
use Gemini\Enums\Role;

class GeminiService
{
    public function ask(string $question): string
    {
        $prompt = "Чи бол Монголын хууль эрх зүйн талаар ерөнхий мэдээлэл өгдөг AI туслах. ".
            "Хариултаа заавал Монгол хэлээр, ойлгомжтой, цэгцтэй гарга. ".
            "Хэрэглэгчийн асуулт: '{$question}'";

        try {
            $result = Gemini::generativeModel(model: 'gemini-2.0-flash')->generateContent($prompt);
            return $result->text();

        } catch (\Exception $e) {
            report($e);
            return 'Уучлаарай, одоогоор хариулт өгөх боломжгүй байна. Та дараа дахин оролдоно уу.' . $e->getMessage();
        }
    }
}
