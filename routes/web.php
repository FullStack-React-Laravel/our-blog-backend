<?php
require __DIR__ . '/auth.php';

use App\Http\Controllers\API\V1\CategoryController;
use App\Http\Controllers\API\V1\LatestPosts;
use App\Http\Controllers\API\V1\PostController;
use App\Http\Controllers\API\V1\TagController;
use App\Http\Controllers\API\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::group(['prefix' => 'api/v1'], function () {
    Route::get('/posts/latest', LatestPosts::class);
    Route::get('/posts/search', [PostController::class, 'search']);

    Route::resource('/users', UserController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/tags', TagController::class);
    Route::apiResource('/posts', PostController::class);
    Route::get('/auth/user', [UserController::class, 'authUser'])->middleware('auth:sanctum');
});
