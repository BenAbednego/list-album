<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Guest Landing Page
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('home');
})->name('home');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Protected Dashboard Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard & Album Routes
    Route::get('/dashboard', [AlbumController::class, 'index'])->name('dashboard');
    Route::post('/albums', [AlbumController::class, 'store'])->name('albums.store');
    Route::put('/albums/{album}', [AlbumController::class, 'update'])->name('albums.update');
    Route::delete('/albums/{album}', [AlbumController::class, 'destroy'])->name('albums.destroy');

    // Photo Routes
    Route::get('/photos/create', [PhotoController::class, 'create'])->name('photos.create');
    Route::post('/photos', [PhotoController::class, 'store'])->name('photos.store');
    Route::get('/photos/{photo}', [PhotoController::class, 'show'])->name('photos.show');
    Route::get('/photos/{photo}/edit', [PhotoController::class, 'edit'])->name('photos.edit');
    Route::put('/photos/{photo}', [PhotoController::class, 'update'])->name('photos.update');
    Route::delete('/photos/{photo}', [PhotoController::class, 'destroy'])->name('photos.destroy');
});
