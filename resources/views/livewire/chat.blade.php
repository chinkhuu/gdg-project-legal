<div class="max-w-2xl mx-auto p-6 bg-white rounded-2xl shadow-xl">
    <h1 class="text-2xl font-bold text-zinc-800 text-center mb-4">Хуулийн AI Туслах</h1>
    <p class="text-sm text-zinc-500 text-center mb-6">
        <strong>Анхааруулга:</strong> Энэхүү систем нь зөвхөн мэдээллийн зорилготой.
    </p>

    <div
        id="chat-window"
        class="h-96 overflow-y-auto flex flex-col space-y-3 mb-4 px-3 py-2 bg-gray-50 rounded-lg"
    >
        @foreach($messages as $msg)
            <div
                class="max-w-[80%] px-4 py-2 rounded-lg break-words self-start"
                @class([
                    'bg-gray-100 text-gray-800 ml-0 text-left' => $msg['sender'] === 'ai',
                    'bg-blue-100 text-blue-900 ml-auto text-right' => $msg['sender'] === 'user',
                ])
            >
                {{ $msg['text'] }}
            </div>
        @endforeach

        @if($loading)
            <div class="flex justify-center">
                <svg class="animate-spin h-6 w-6 text-amber-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                </svg>
            </div>
        @endif
    </div>

    <form wire:submit.prevent="send" class="flex space-x-2">
        <input
            wire:model.defer="question"
            type="text"
            placeholder="Асуултаа энд бичнэ үү..."
            class="flex-1 px-4 py-2 border border-zinc-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400"
            autocomplete="off"
        />
        <button
            type="submit"
            class="px-4 py-2 bg-amber-500 text-white font-semibold rounded-lg hover:bg-amber-600 transition disabled:opacity-50"
            @disabled($loading)
        >
            Илгээх
        </button>
    </form>
</div>

<script>
    window.addEventListener('scroll-to-bottom', () => {
        const c = document.getElementById('chat-window');
        if (c) c.scrollTop = c.scrollHeight;
    });
</script>
