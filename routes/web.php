<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get("/posts/latest", \App\Http\Controllers\LatestPosts::class);

Route::resource("/users", \App\Http\Controllers\UserController::class);
Route::resource("/categories", \App\Http\Controllers\CategoryController::class);
Route::resource("/tags", \App\Http\Controllers\TagController::class);
Route::resource("/posts", \App\Http\Controllers\PostController::class);


require __DIR__ . '/auth.php';
