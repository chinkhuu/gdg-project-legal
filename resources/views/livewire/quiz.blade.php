<div class="max-w-2xl mx-auto bg-white rounded-2xl p-6 shadow-md">
    <h1 class="text-3xl font-bold text-center mb-4">{{ $quiz->title }}</h1>

    @if (! $completed)
        <form wire:submit.prevent="submitAnswer">
            <h2 class="text-xl font-semibold mb-4">
                Асуулт {{ $currentIndex + 1 }}: {{ $questions[$currentIndex]['text'] }}
            </h2>

            <div class="space-y-3 mb-6">
                @foreach($questions[$currentIndex]['answers'] as $answer)
                    <label class="flex items-center space-x-2">
                        <input
                            type="radio"
                            wire:model="selectedAnswer"
                            value="{{ $answer['id'] }}"
                            class="form-radio h-4 w-4 text-blue-600"
                        />
                        <span>{{ $answer['text'] }}</span>
                    </label>
                @endforeach
            </div>

            <button
                type="submit"
                class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition"
            >
                Илгээх
            </button>
        </form>
    @else
        <div class="text-center">
            <h2 class="text-2xl font-bold mb-4">Сорил дууслаа!</h2>
            <p class="text-lg mb-4">
                Таны оноо: <span class="font-semibold">{{ $score }}</span> / {{ count($questions) }}
            </p>
            <a
                href="{{ route('quizzes') }}"
                class="inline-block px-4 py-2 bg-zinc-200 text-zinc-900 rounded hover:bg-zinc-300 transition"
            >
                Бүх сорил үзэх
            </a>
        </div>
    @endif
</div>
