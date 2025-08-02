<div class="max-w-2xl mx-auto p-6 bg-white rounded-2xl shadow-xl">
    <h1 class="text-2xl font-bold text-zinc-900 text-center mb-4">Хуулийн AI Туслах</h1>
    <p class="text-sm text-zinc-500 text-center mb-6">
        <strong>Анхааруулга:</strong> Энэхүү систем нь зөвхөн мэдээллийн зорилготой.
    </p>
    <div
        id="chat-window"
        class="h-96 overflow-y-auto flex flex-col space-y-4 mb-4 px-4 py-3 bg-blue-50 rounded-lg"
    >
        @foreach($messages as $msg)
            <div
                class="max-w-[85%] px-4 py-2 rounded-xl break-words"
                @class([
                    'bg-white text-zinc-800 self-start ring-1 ring-inset ring-gray-200 prose prose-zinc max-w-none' => $msg['sender'] === 'ai',
                    'bg-black text-white self-end' => $msg['sender'] === 'user',
                ])
            >
                {!! $msg['text'] !!}
            </div>
        @endforeach

        @if($loading)
            <div class="flex justify-start">
                <div class="px-4 py-2 rounded-xl bg-gray-200">
                    <div class="flex items-center justify-center space-x-2">
                        <div class="w-2 h-2 rounded-full bg-zinc-500 animate-pulse"></div>
                        <div class="w-2 h-2 rounded-full bg-zinc-500 animate-pulse"
                             style="animation-delay: 0.2s;"></div>
                        <div class="w-2 h-2 rounded-full bg-zinc-500 animate-pulse"
                             style="animation-delay: 0.4s;"></div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <form wire:submit.prevent="send" class="flex space-x-3">
        <input
            wire:model.defer="question"
            type="text"
            placeholder="Асуултаа энд бичнэ үү..."
            class="flex-1 px-4 py-2 border border-zinc-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black"
            autocomplete="off"
            @disabled($loading)
        />
        <button
            type="submit"
            class="px-5 py-2 bg-black text-white font-semibold rounded-lg hover:bg-zinc-800 transition disabled:opacity-50"
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
