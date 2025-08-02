<div class="bg-white py-12 rounded-3xl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold mb-12 text-center text-zinc-800">Хамгийн шилдэг хуульчид</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
            @forelse($lawyers as $lawyer)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col group">
                    <!-- Image -->
                    <div class="w-full h-80 overflow-hidden">
                        <img
                            src="{{ Storage::url($lawyer->profile) ?? 'https://ui-avatars.com/api/?name=' . urlencode($lawyer->name) . '&background=f59e0b&color=fff&size=320' }}"
                            alt="{{ $lawyer->name }}"
                            class="w-full h-full object-cover"
                        >
                    </div>

                    <!-- Info -->
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div class="flex justify-between items-start">
                            <div>
                                <h2 class="text-2xl font-bold text-zinc-900">{{ $lawyer->name }}</h2>
                                <p class="text-gray-500 mt-1">
                                    {{ $lawyer->segment->name ?? 'Мэргэжилтэн' }}
                                </p>
                            </div>
                            {{-- Статический рейтинг 4.7/5 --}}
                            <div class="flex items-baseline space-x-1">
                                <span class="text-xl font-semibold text-yellow-400">4.7</span>
                                <span class="text-gray-500">/5</span>
                            </div>
                        </div>
                    </div>

                </div>
            @empty
                <div class="col-span-full flex flex-col items-center justify-center py-16 bg-white rounded-2xl shadow-sm">
                    <svg class="w-16 h-16 text-zinc-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M12 9v2m0 4h.01m-6.938
                     4h13.856c1.54 0 2.502-1.667 1.732-3L13.732
                     4c-.77-1.333-2.694-1.333-3.464 0L3.34
                     16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <p class="text-xl font-semibold text-zinc-600">Илэрц олдсонгүй</p>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-12">
            <flux:button href="{{route('lawyers')}}" variant="primary">Бүх хуульчид</flux:button>
        </div>
    </div>
</div>
