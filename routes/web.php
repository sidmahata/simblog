<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostCommentController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', fn () => view('auth.login'))->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
    Route::get('/register', fn () => view('auth.register'))->name('register');
    // Route::get('/forgot-password', fn () => view('auth.forgot-password'))->name('password.request');
    // Route::get('/reset-password/{token}', fn ($token) => view('auth.reset-password', ['token' => $token]))->name('password.reset');
});

// ADMIN AUTH
Route::prefix('admin')->middleware('guest')->group(function () {
    Route::get('/login', fn () => view('admin.auth.login'))->name('admin.login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('admin.login.store');
});

Route::prefix('admin')
    ->name('admin.')
    // ->middleware(['auth','role:admin'])
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('users', UserController::class);
        Route::resource('posts', PostController::class);
        Route::resource('posts.comments', PostCommentController::class)
            ->only(['store', 'update', 'destroy'])
            ->shallow();
    });
