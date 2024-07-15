<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get("/posts/latest", \App\Http\Controllers\LatestPosts::class);

Route::resource("/users", \App\Http\Controllers\UserController::class);
Route::resource("/categories", \App\Http\Controllers\CategoryController::class);
Route::resource("/tags", \App\Http\Controllers\TagController::class);
Route::resource("/posts", \App\Http\Controllers\PostController::class);
Route::get('/search' , function(Request $r){
    return  search(
            $r->model,
            $r->column,
            $r->search,
            $r->query('paginate', false)
        );

});
Route::resource('/comments',\App\Http\Controllers\CommentController::class);
Route::resource('/reactions' , \App\Http\Controllers\ReactionController::class);


require __DIR__ . '/auth.php';
