<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WriteupController;
use App\Models\Category;
use App\Models\Ctf;
use App\Models\Writeup;

Route::get('/', function () {
    $recent = Writeup::with(['category', 'ctf', 'user'])->latest()->take(5)->get();
    return view('pages.home', compact('recent'));
});

Route::get('/writeups', [WriteupController::class, 'index'])->name('writeups');

Route::get('/stats', function () {
    $totalWriteups = Writeup::count();
    $totalCategories = Category::count();
    $totalCtfs = Ctf::count();
    $recent = Writeup::with(['user', 'category', 'ctf'])->latest()->take(10)->get();

    return view('pages.stats', compact('totalWriteups', 'totalCategories', 'totalCtfs', 'recent'));
})->name('stats');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
