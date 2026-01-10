<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('genealogy', \App\Livewire\Genealogy::class)
    ->middleware(['auth', 'verified'])
    ->name('genealogy');

Route::get('commissions', \App\Livewire\Commissions::class)
    ->middleware(['auth', 'verified'])
    ->name('commissions');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
