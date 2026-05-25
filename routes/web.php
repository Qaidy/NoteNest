<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;

// ⛔ HAPUS welcome page
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

// dashboard (protected)
Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

// auth required routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('notes', NoteController::class);
});

require __DIR__.'/auth.php';