<?php

use App\Livewire\Dashboard;
use App\Livewire\Tasks;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

// Route::view('dashboard', 'dashboard')
//   ->middleware(['auth', 'verified'])
//   ->name('dashboard');

Route::view('profile', 'profile')
  ->middleware(['auth'])
  ->name('profile');

Route::get('/tasks', Tasks::class)->middleware(['auth'])->name('tasks');
Route::get('/dashboard', Dashboard::class)->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
