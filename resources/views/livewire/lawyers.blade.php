<div class="bg-gray-50 py-16 rounded-3xl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-sm font-medium uppercase tracking-wider mb-2">Манай Хуульчид</p>

            <h1 class="text-3xl font-serif font-bold mb-4">
                Мэргэжлийн <span class="italic">туршлагатай</span> хуульчдаас сонголтоо хийнэ үү
            </h1>
        </div>

        <div class="flex flex-col sm:flex-row sm:justify-center items-center gap-4 mb-10">
            <div class="relative w-full sm:w-auto">
                <select
                    wire:model.live="selectedSegment"
                    class="w-full sm:w-auto appearance-none pl-4 pr-10 py-2.5 rounded-lg border border-zinc-300 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-amber-400"
                >
                    <option value="">-- Бүх чиглэлээр --</option>
                    @foreach($segments as $segment)
                        <option value="{{ $segment->id }}">{{ $segment->name }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-zinc-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                    </svg>
                </div>
            </div>

            <div class="relative w-full sm:w-auto">
                <input
                    type="text"
                    wire:model.live.debounce.500ms="search"
                    placeholder="Хуульчийн нэрээр хайх..."
                    class="w-full sm:w-64 pl-10 pr-4 py-2.5 rounded-lg border border-zinc-300 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-amber-400"
                />
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-zinc-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="relative">
            <div wire:loading.flex
                 class="absolute inset-0 bg-white/50 backdrop-blur-sm z-10 items-center justify-center">
                <svg class="animate-spin h-8 w-8 text-amber-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962
                             7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </div>

            <div wire:loading.remove class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($lawyers as $lawyer)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col group">
                        <img
                            class="w-full h-60 object-cover"
                            src="{{ Storage::url($lawyer->profile) ?? 'https://ui-avatars.com/api/?name=' . urlencode($lawyer->name) . '&background=f59e0b&color=fff&size=320' }}"
                            alt="{{ $lawyer->name }}"
                        >

                        <div class="p-6 flex-grow flex flex-col justify-between">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h2 class="text-2xl font-bold text-zinc-900">{{ $lawyer->name }}</h2>
                                    <p class="text-gray-500 mt-1">
                                        {{ $lawyer->segment->name ?? 'Мэргэжилтэн' }}
                                    </p>
                                </div>
                                <div class="flex flex-col items-end">
                                    <span class="text-3xl font-bold text-amber-500 leading-none">4.7</span>
                                    <span class="text-gray-500 text-sm">/5</span>
                                </div>
                            </div>

                            <div class="mt-6">
                                <flux:modal.trigger
                                    name="lawyer-detail-{{ $lawyer->id }}"
                                    class="w-full block text-center py-2 font-semibold bg-zinc-800 text-white rounded-full transition hover:bg-zinc-900"
                                >
                                    <flux:button class="w-full" variant="primary">Дэлгэрэнгүй</flux:button>

                                </flux:modal.trigger>
                            </div>
                        </div>

                        <flux:modal name="lawyer-detail-{{ $lawyer->id }}" class="md:max-w-2xl text-left">
                            <div class="flex flex-col sm:flex-row gap-6 sm:gap-8 p-1">
                                <div class="flex-shrink-0 text-center sm:text-left">
                                    <img
                                        class="w-40 h-40 rounded-full object-cover mx-auto border-4 border-white shadow-lg"
                                        src="{{ $lawyer->profile ?? 'https://ui-avatars.com/api/?name=' . urlencode($lawyer->name) . '&background=f59e0b&color=fff&size=160' }}"
                                        alt="{{ $lawyer->name }}"
                                    >
                                    <h2 class="mt-4 text-2xl font-bold text-zinc-900">{{ $lawyer->name }}</h2>
                                    @if($lawyer->segment)
                                        <p class="text-amber-600 font-semibold">{{ $lawyer->segment->name }}</p>
                                    @endif
                                </div>

                                <div class="flex-grow pt-2">
                                    <flux:heading size="lg">Холбоо барих мэдээлэл</flux:heading>
                                    <div class="mt-4 space-y-4 text-zinc-700">
                                        <div class="flex items-start gap-3">
                                            <svg class="w-5 h-5 text-zinc-400 mt-1 flex-shrink-0"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                 fill="currentColor">
                                                <path fill-rule="evenodd"
                                                      d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741
                                                         5.741 0 00.281-.14c.186-.1.4-.27.615-.454L16 14.55V7a6 6 0 10-12
                                                         0v7.55l4.11 3.918zM10 2a4 4 0 100 8 4 4 0 000-8z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                            <span>Бүс нутаг: <span
                                                    class="font-medium text-zinc-900">{{ $lawyer->region ?? 'Тодорхойгүй' }}</span></span>
                                        </div>
                                        <div class="flex items-start gap-3">
                                            <svg class="w-5 h-5 text-zinc-400 mt-1 flex-shrink-0"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                 fill="currentColor">
                                                <path d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118
                                                         0L19 7.162V6a2 2 0 00-2-2H3z"/>
                                                <path d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46
                                                         0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z"/>
                                            </svg>
                                            <span>И-мэйл: <a href="mailto:{{ $lawyer->email }}"
                                                             class="font-medium text-blue-600 hover:underline">{{ $lawyer->email }}</a></span>
                                        </div>
                                        <div class="flex items-start gap-3">
                                            <svg class="w-5 h-5 text-zinc-400 mt-1 flex-shrink-0"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                 fill="currentColor">
                                                <path fill-rule="evenodd"
                                                      d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0
                                                         011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542
                                                         11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5
                                                         1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5
                                                         1.5 0 01-1.5 1.5h-1.528a1.5 1.5 0 01-1.475-1.232l-.358-1.433a1.5
                                                         1.5 0 00-1.433-.966H8.57a1.5 1.5 0 00-1.433.966l-.358
                                                         1.433A1.5 1.5 0 015.303 18H3.5A1.5 1.5 0 012
                                                         16.5v-13z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                            <span>Утас: <a href="tel:{{ $lawyer->phone }}"
                                                           class="font-medium text-blue-600 hover:underline">{{ $lawyer->phone }}</a></span>
                                        </div>
                                    </div>

                                    <div class="mt-8 border-t pt-6 flex flex-col sm:flex-row gap-3">
                                        <flux:button as="a" href="mailto:{{ $lawyer->email }}"
                                                     class="w-full justify-center">
                                            <svg class="w-5 h-5 -ml-1 mr-2" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0
                                                          001.118 0L19 7.162V6a2 2 0 00-2-2H3z"/>
                                                <path d="M19 8.839l-7.77 3.885a2.75 2.75 0
                                                          01-2.46 0L1 8.839V14a2 2 0 002
                                                          2h14a2 2 0 002-2V8.839z"/>
                                            </svg>
                                            И-мэйл илгээх
                                        </flux:button>
                                        <flux:button as="a" href="#" variant="primary" class="w-full justify-center">
                                            <svg class="w-5 h-5 -ml-1 mr-2" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M5.25 12.223a.75.75 0 001.06
                                                          1.06l4.25-4.25a.75.75 0 00-1.06-1.06L5.25
                                                          12.223zM12.223 5.25a.75.75 0 00-1.06
                                                          1.06l4.25 4.25a.75.75 0 001.06-1.06l-4.25-4.25z"/>
                                                <path fill-rule="evenodd"
                                                      d="M18 10a8 8 0 11-16 0 8 8 0
                                                         0116 0zM4 10a6 6 0 1112 0 6 6 0
                                                         01-12 0z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                            Уулзалт товлох
                                        </flux:button>
                                    </div>
                                </div>
                            </div>
                        </flux:modal>
                    </div>
                @empty
                    <div
                        class="col-span-full flex flex-col items-center justify-center py-16 bg-white rounded-2xl shadow-sm">
                        <svg class="w-16 h-16 text-zinc-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0
                                     2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464
                                     0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <p class="text-xl font-semibold text-zinc-600">Илэрц олдсонгүй</p>
                        <p class="text-zinc-400 mt-1">Таны хайлт болон шүүлтүүрт тохирох мэдээлэл алга.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
