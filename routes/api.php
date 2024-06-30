<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::resource("/users", \App\Http\Controllers\UserController::class);
Route::resource("/categories", \App\Http\Controllers\CategoryController::class);
Route::resource("/tags", \App\Http\Controllers\TagController::class);
Route::resource("/posts", \App\Http\Controllers\PostController::class);
