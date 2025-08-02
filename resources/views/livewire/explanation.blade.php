<div class="w-full px-4 py-8 space-y-4">
    <h1 class="text-3xl font-bold text-zinc-800 text-center mb-6">
        Нэр томьёонуудын тайлбар
    </h1>

    @foreach($explanations as $term)
        <div class="flex items-center justify-between bg-white rounded-2xl shadow p-4">
            <!-- the “question” -->
            <span class="text-lg font-medium text-zinc-900">
                {{ $term->name }}
            </span>

            <!-- the button that triggers the modal -->
            <flux:modal.trigger name="explanation-{{ $term->id }}">
                <flux:button size="sm" variant="primary">
                    Тайлбар
                </flux:button>
            </flux:modal.trigger>

            <!-- the modal itself -->
            <flux:modal name="explanation-{{ $term->id }}" class="md:max-w-xl">
                <div class="space-y-4 p-4">
                    <flux:heading size="lg">
                        {{ $term->name }}
                    </flux:heading>

                    <flux:text class="whitespace-pre-line">
                        {!! $term->description !!}
                    </flux:text>

{{--                    <div class="flex justify-end">--}}
{{--                        <flux:button size="sm" @click="$dispatch('close')" variant="secondary">--}}
{{--                            Хаах--}}
{{--                        </flux:button>--}}
{{--                    </div>--}}
                </div>
            </flux:modal>
        </div>
    @endforeach

    @if($explanations->isEmpty())
        <p class="text-center text-zinc-500 mt-8">
            Ямар ч тайлбар олдсонгүй.
        </p>
    @endif
</div>
