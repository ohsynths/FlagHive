<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\WriteupController;

Route::get('/', [PageController::class, 'home'])->name('home');

Route::prefix('writeups')->group(function () {
    Route::get('/', [WriteupController::class, 'index'])->name('writeups');
    Route::get('/create', [WriteupController::class, 'create'])->middleware('auth')->name('writeups.create');
    Route::post('/', [WriteupController::class, 'store'])->middleware('auth')->name('writeups.store');
    Route::get('/{writeup}', [WriteupController::class, 'show'])->name('writeups.show');
    Route::get('/{writeup}/edit', [WriteupController::class, 'edit'])->middleware('auth')->name('writeups.edit');
    Route::put('/{writeup}', [WriteupController::class, 'update'])->middleware('auth')->name('writeups.update');
    Route::delete('/{writeup}', [WriteupController::class, 'destroy'])->middleware('auth')->name('writeups.destroy');
});

Route::get('/stats', [PageController::class, 'stats'])->name('stats');

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register')->name('register.post');
    Route::post('/logout', 'logout')->name('logout');
});

Route::middleware(['auth', 'check.banned'])->group(function () {
    Route::get('/profile', [PageController::class, 'profile'])->name('profile');
    Route::post('/profile/avatar', [PageController::class, 'updateAvatar'])->name('profile.avatar');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/writeups', [AdminController::class, 'writeups'])->name('writeups');
    Route::get('/logs', [AdminController::class, 'logs'])->name('logs');
    Route::post('/users/{user}/ban', [AdminController::class, 'banUser'])->name('users.ban');
    Route::post('/users/{user}/unban', [AdminController::class, 'unbanUser'])->name('users.unban');
    Route::delete('/writeups/{writeup}', [AdminController::class, 'deleteWriteup'])->name('writeups.delete');
});
