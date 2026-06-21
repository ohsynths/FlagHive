<?php

use App\Models\ActivityLog;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\WriteupController;

Route::get('/', [PageController::class, 'home'])->middleware('throttle:60,1')->name('home');
Route::get('/u/{user}', [PageController::class, 'publicProfile'])->middleware('throttle:60,1')->name('user.public');

Route::prefix('writeups')->group(function () {
    Route::get('/', [WriteupController::class, 'index'])->middleware('throttle:60,1')->name('writeups');
    Route::get('/create', [WriteupController::class, 'create'])->middleware(['auth', 'verified'])->name('writeups.create');
    Route::post('/', [WriteupController::class, 'store'])->middleware(['auth', 'verified'])->name('writeups.store');
    Route::get('/{writeup}', [WriteupController::class, 'show'])->middleware('throttle:60,1')->name('writeups.show');
    Route::get('/{writeup}/edit', [WriteupController::class, 'edit'])->middleware(['auth', 'verified'])->name('writeups.edit');
    Route::put('/{writeup}', [WriteupController::class, 'update'])->middleware(['auth', 'verified'])->name('writeups.update');
    Route::delete('/{writeup}', [WriteupController::class, 'destroy'])->middleware(['auth', 'verified'])->name('writeups.destroy');
});

Route::get('/stats', [PageController::class, 'stats'])->middleware('throttle:30,1')->name('stats');

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login')->middleware('throttle:5,1')->name('login.post');
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register')->middleware('throttle:5,1')->name('register.post');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/forgot-password', 'showForgotPassword')->name('password.request');
    Route::post('/forgot-password', 'sendResetLink')->name('password.email');
    Route::get('/reset-password/{token}', 'showResetPassword')->name('password.reset');
    Route::post('/reset-password', 'resetPassword')->name('password.update');
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

Route::get('/email/verify', function () {
    if (auth()->user()?->hasVerifiedEmail()) {
        return redirect()->route('home');
    }
    return view('auth.verify-notice');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    ActivityLog::create([
        'user_id' => auth()->id(),
        'action' => 'user.verified',
        'description' => 'Verified email address',
    ]);

    return redirect()->route('verification.success');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function () {
    auth()->user()->sendEmailVerificationNotification();
    return back()->with('resent', true);
})->middleware(['auth', 'throttle:3,1'])->name('verification.send');

Route::get('/email/verify-success', function () {
    return view('auth.verify-success');
})->name('verification.success');
