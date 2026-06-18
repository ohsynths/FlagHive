<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WriteupController;
use App\Models\Category;
use App\Models\Writeup;

Route::get('/', function () {
    $recent = Writeup::with(['category', 'user'])->latest()->take(5)->get();
    return view('pages.home', compact('recent'));
});

Route::get('/writeups', [WriteupController::class, 'index'])->name('writeups');
Route::get('/writeups/create', [WriteupController::class, 'create'])->middleware('auth')->name('writeups.create');
Route::post('/writeups', [WriteupController::class, 'store'])->middleware('auth')->name('writeups.store');
Route::get('/writeups/{writeup}', [WriteupController::class, 'show'])->name('writeups.show');

Route::get('/stats', function () {
    $totalWriteups = Writeup::count();
    $totalCategories = Category::count();
    $totalCtfs = Writeup::distinct('ctf')->count('ctf');
    $recent = Writeup::with(['user', 'category'])->latest()->take(10)->get();

    return view('pages.stats', compact('totalWriteups', 'totalCategories', 'totalCtfs', 'recent'));
})->name('stats');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/profile', function () {
    $user = auth()->user();
    $writeups = $user->writeups()->with(['category'])->latest()->paginate(20);
    return view('pages.profile', compact('user', 'writeups'));
})->middleware('auth')->name('profile');

Route::post('/profile/avatar', function (Request $request) {
    $request->validate([
        'avatar' => ['required', 'image', 'mimes:png,jpg,jpeg,gif', 'max:2048'],
    ]);

    $user = auth()->user();

    if ($user->avatar) {
        Storage::disk('public')->delete($user->avatar);
    }

    $path = $request->file('avatar')->store('avatars', 'public');
    $user->update(['avatar' => $path]);

    return back()->with('success', 'Avatar updated.');
})->middleware('auth')->name('profile.avatar');
