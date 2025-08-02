<div class="max-w-2xl mx-auto bg-white rounded-2xl p-6 shadow-md">
    <h1 class="text-3xl font-bold text-center mb-4">{{ $quiz->title }}</h1>

    @if (! $completed)
        <form wire:submit.prevent="submitAnswer">
            <h2 class="text-xl font-semibold mb-4">
                Асуулт {{ $currentIndex + 1 }}: {{ $questions[$currentIndex]['text'] }}
            </h2>

            <div class="space-y-3 mb-6">
                <flux:radio.group wire:model="selectedAnswer" label="Сонголтоо хийнэ үү:">
                    @foreach($questions[$currentIndex]['answers'] as $answer)
                        <flux:radio
                            value="{{ $answer['id'] }}"
                            label="{{ $answer['text'] }}"
                        />
                    @endforeach
                </flux:radio.group>
            </div>

            <flux:button variant="primary" type="submit" class="w-full">Илгээх</flux:button>
        </form>
    @else
        <div class="text-center">
            <h2 class="text-2xl font-bold mb-4">Сорил дууслаа!</h2>
            <p class="text-lg mb-4">
                Таны оноо: <span class="font-semibold">{{ $score }}</span> / {{ count($questions) }}
            </p>

            <flux:button href="{{ route('quizzes') }}" variant="primary" class="w-full">Бүх сорил үзэх</flux:button>
        </div>
    @endif
</div>
