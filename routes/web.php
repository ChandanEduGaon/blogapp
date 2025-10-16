<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;





Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::get('/login', [UserController::class, 'login'])->name('login');


Route::get('/google/auth', [SocialAuthController::class, 'google_auth'])->name('google.auth');
Route::get('/google/callback', [SocialAuthController::class, 'google_callback'])->name('google.callback');
Route::get('/facebook/auth', [SocialAuthController::class, 'facebook_auth'])->name('facebook.auth');
Route::get('/facebook/callback', [SocialAuthController::class, 'facebook_callback'])->name('facebook.callback');

Route::post('/register/save', [UserController::class, 'register_save'])->name('register.save');
Route::post('/login/check', [UserController::class, 'login_check'])->name('login.check');

Route::middleware(['auth', 'loogged.user'])->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::post('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::get('/post/list', [PostController::class, 'list'])->name('post.list');
    Route::get('/post/detail', [PostController::class, 'detail'])->name('post.detail');
    Route::get('/post/delete', [PostController::class, 'delete'])->name('post.delete');
    Route::post('/post/update', [PostController::class, 'update'])->name('post.update');
    Route::post('/comment/create', [PostController::class, 'create_comment'])->name('create.comment');
    Route::get('/comment/delete', [PostController::class, 'delete_comment'])->name('comment.delete');
});

Route::prefix('admin')->middleware(['auth', 'loogged.user', 'role'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.home');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/posts', [AdminController::class, 'posts'])->name('admin.posts');

    Route::get('posts/{post}', [AdminController::class, 'show']);
    Route::get('posts/{post}/edit', [AdminController::class, 'edit']);
    Route::put('posts/{post}', [AdminController::class, 'update']);
    Route::delete('posts/{post}', [AdminController::class, 'destroy']);

    Route::get('users/{user}', [AdminUserController::class, 'show'])->name('admin.users.show');
    Route::get('users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
});
