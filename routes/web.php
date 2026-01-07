<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostCommentController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', fn () => view('auth.login'))->name('login');
    Route::get('/register', fn () => view('auth.register'));
});

// ADMIN AUTH
Route::prefix('admin')->middleware('guest')->group(function () {
    Route::get('/login', fn () => view('admin.auth.login'))->name('admin.login');
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth','role:admin'])
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('users', UserController::class);
        Route::resource('posts', PostController::class);
        Route::resource('posts.comments', PostCommentController::class)
            ->only(['store', 'update', 'destroy'])
            ->shallow();
    });
