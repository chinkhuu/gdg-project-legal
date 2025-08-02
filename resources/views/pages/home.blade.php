@extends('layouts.app')

@section('content')
    <section class="bg-blue-50 dark:bg-zinc-900 text-zinc-900 dark:text-white py-20 rounded-3xl shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm font-medium uppercase tracking-wider mb-2">ТАВТАЙ МОРИЛ</p>
            <h1 class="text-5xl font-serif font-bold mb-4">
                Хуулийн <span class="italic">шуурхай</span> шийдлийг танд зориуллаа.
            </h1>
            <p class="text-lg mb-8">
                Манай платформ нь таны хэрэгцээг тодорхойлж, шаардлагатай мэдээллийг автоматаар хүргэж, таны цагийг хэмнэнэ.
            </p>
            <div class="flex justify-center gap-4 mb-8">
                <flux:button href="{{route('chat')}}" variant="primary">Үйлчилгээ авах</flux:button>
                <flux:button href="{{route('lawyers')}}" variant="outline">Хуульчидтай холбогдох</flux:button>
            </div>
            <p class="text-sm text-zinc-600 dark:text-zinc-400">500+ хуульчид платформд идэвхитэй ажиллаж байна</p>
        </div>
    </section>

    <br>

    <livewire:home/>
@endsection
