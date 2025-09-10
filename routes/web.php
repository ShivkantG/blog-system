<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/', [PostController::class, 'welcome'])->name('public.welcome');

Route::get('/dashboard', [PostController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/blogs', [PostController::class, 'blogs'])->name('public.blogs');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Posts routes
    Route::resource('posts', PostController::class);
    // Single Post by Slug
    Route::get('/post/{slug}', [PostController::class, 'show'])->name('posts.slug');

    Route::post('/post/{id}/like', [PostController::class, 'like'])->name('posts.like');
    Route::post('/post/{id}/dislike', [PostController::class, 'dislike'])->name('posts.dislike');
    
    
    Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/posts', [AdminController::class, 'posts'])->name('admin.posts');

        // User actions
        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
        Route::patch('/users/{user}/toggle', [AdminController::class, 'toggleUser'])->name('admin.users.toggle');

        // Post actions
        Route::delete('/posts/{post}', [AdminController::class, 'destroyPost'])->name('admin.posts.destroy');
        Route::get('/posts/{post}/edit', [AdminController::class, 'editPost'])->name('admin.posts.edit');
        Route::put('/posts/{post}', [AdminController::class, 'updatePost'])->name('admin.posts.update');
    });


});


require __DIR__ . '/auth.php';
