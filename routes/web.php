<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Livewire\Volt\Volt;

Route::get('/', function () {
    $lawyers = \App\Models\Attorney::all();
    return view('pages.home', compact('lawyers'));
})->name('home');

Route::get('/gemini-chat', function () {
    return view('chat');
});

Route::get('/key-test', function (){
    return dd(env('GEMINI_API_KEY'));
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::get('chat', function () {
    return Inertia::render('Chat');
})->name('chat');



require __DIR__.'/auth.php';
