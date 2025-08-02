<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/lawyers' , \App\Livewire\Lawyers::class )->name('lawyers');
Route::get('/explanations' , \App\Livewire\Explanation::class )->name('explanations');
Route::get('/chat', \App\Livewire\Chat::class)->name('chat');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
