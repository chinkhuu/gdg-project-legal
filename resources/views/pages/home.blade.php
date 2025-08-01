@extends('layouts.app')

@section('content')
    <section class="bg-amber-50 dark:bg-zinc-900 text-zinc-900 dark:text-white py-20">
        <div class="max-w-4xl mx-auto text-center px-4">
            <p class="text-sm font-medium uppercase tracking-wider mb-2">WELCOME TO PROSPECT</p>
            <h1 class="text-5xl font-serif font-bold mb-4">Built for <span class="italic">Fast-Moving</span> Businesses.</h1>
            <p class="text-lg mb-8">Prospect surfaces what matters, automates the rest, and keeps you moving with intention.</p>
            <div class="flex justify-center gap-4 mb-8">
                <flux:button variant="primary" >Get started now</flux:button>
                <flux:button variant="outline">Explore more</flux:button>
            </div>
            <div class="flex justify-center items-center space-x-2 mb-2">

            </div>
            <p class="text-sm text-zinc-600 dark:text-zinc-400">Rated 4.97/5 from 500+ reviews</p>
        </div>
    </section>
@endsection
