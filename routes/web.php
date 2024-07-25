<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LatestPosts;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'Home');

Route::get('/posts/latest', LatestPosts::class);
Route::get('/posts/search', [PostController::class, 'search']);

Route::resource('/users', UserController::class);
Route::resource('/categories', CategoryController::class);
Route::resource('/tags', TagController::class);
Route::resource('/posts', PostController::class);


require __DIR__.'/auth.php';
