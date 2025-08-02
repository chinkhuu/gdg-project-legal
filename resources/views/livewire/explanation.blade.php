<div class="bg-gray-50 py-16 rounded-3xl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-800 text-center mb-8">
            Нэр томьёонуудын тайлбар
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($explanations as $term)
                <div
                    class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-6 flex flex-col">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                        {{ $term->name }}
                    </h3>
                    <p class="text-gray-600 flex-grow mb-4">
                        {!! Str::limit($term->description, 100, '...')  !!}
                    </p>
                    <br>
                    <div class="mt-auto">
                        <flux:modal.trigger name="explanation-{{ $term->id }}">
                            <flux:button class="w-full" variant="primary">Бүрэн унших</flux:button>
                        </flux:modal.trigger>
                    </div>

                    <flux:modal name="explanation-{{ $term->id }}" class="md:max-w-2xl">
                        <div class="p-6">
                            <flux:heading size="xl" class="mb-4">
                                {{ $term->name }}
                            </flux:heading>

                            <div class="prose prose-lg max-w-none text-gray-700 whitespace-pre-line">
                                {!! $term->description !!}
                            </div>
                        </div>
                    </flux:modal>
                </div>
            @empty
                <p class="text-center text-zinc-500 mt-8 col-span-full">
                    Ямар ч тайлбар олдсонгүй.
                </p>
            @endforelse
        </div>
    </div>
</div>
