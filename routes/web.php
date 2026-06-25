<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MemorizationController;

// Rute Tamu (Public)
Route::get('/', [DoaController::class, 'index'])->name('home');
Route::get('/doa/detail/{id}', [DoaController::class, 'detail'])->name('doa.detail');
Route::get('/doa/search', [DoaController::class, 'search'])->name('doa.search');

// Rute Autentikasi
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute Terproteksi (Hanya User Login)
Route::middleware('auth')->group(function () {
    // Favorit Doa
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

    // Progres Hafalan Doa
    Route::get('/memorization', [MemorizationController::class, 'index'])->name('memorization.index');
    Route::post('/memorization/add', [MemorizationController::class, 'add'])->name('memorization.add');
    Route::post('/memorization/update', [MemorizationController::class, 'updateStatus'])->name('memorization.update');
    Route::post('/memorization/remove', [MemorizationController::class, 'remove'])->name('memorization.remove');
});
