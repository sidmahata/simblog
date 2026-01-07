<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostCommentController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PostController as FrontendPostController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth','role:user|admin', 'log.activity'])->group(function () {
    Route::get('/posts/create', [FrontendPostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [FrontendPostController::class, 'store'])->name('posts.store');
    
    Route::middleware('can:update,post')->group(function () {
        Route::get('/posts/{post}/edit', [FrontendPostController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{post}', [FrontendPostController::class, 'update'])->name('posts.update');
    });

    Route::middleware('can:delete,post')->group(function () {
        Route::delete('/posts/{post}', [FrontendPostController::class, 'destroy'])->name('posts.destroy');
    });
});
Route::get('/posts/{post}', [HomeController::class, 'show'])->name('posts.show');

Route::middleware(['auth', 'log.activity'])->group(function () {
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('posts.comments.store');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

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

Route::middleware('guest')->group(function () {

    Route::get('/auth/{provider}', [SocialAuthController::class, 'redirect'])
        ->whereIn('provider', ['google', 'facebook']);

    Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback'])
        ->whereIn('provider', ['google', 'facebook']);
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
