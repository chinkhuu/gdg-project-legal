@extends('layouts.app')

@section('content')
    <section class="bg-blue-50 dark:bg-zinc-900 text-zinc-900 dark:text-white py-20 rounded-3xl shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm font-medium uppercase tracking-wider mb-2">ТАВТАЙ МОРИЛ</p>
            <h1 class="text-5xl font-serif font-bold mb-4">
                Хуулийн <span class="italic">шуурхай</span> шийдлийг танд зориуллаа.
            </h1>
            <p class="text-lg mb-8">
                Манай платформ нь таны хэрэгцээг тодорхойлж, шаардлагатай мэдээллийг автоматаар хүргэж, таны цагийг
                хэмнэнэ.
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

    <section class="bg-blue-50 dark:bg-zinc-900 text-zinc-900 dark:text-white py-20 rounded-3xl shadow-md mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-10">
                Шинэ мэдээ мэдээлэл
            </h2>

            <!-- Зөвхөн нэг анимэйшн wrapper -->
            <div class="flex gap-6 animate-marquee w-max">
                @foreach($informations as $info)
                    <div class="bg-white p-6 rounded-2xl shadow-md w-96 min-h-[220px] shrink-0 text-left">
                        <h2 class="text-lg font-semibold text-zinc-900">{!! $info->title !!}</h2>
                        <p class="text-sm text-zinc-700 break-words">
                            {!! $info->description !!}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <style>
        @keyframes marquee {
            0%   { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }

        .animate-marquee {
            animation: marquee 30s linear infinite;
            display: flex;
        }
    </style>
@endsection
