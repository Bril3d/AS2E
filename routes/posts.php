<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostListController;
use App\Http\Controllers\LikedPostsController;
use App\Http\Controllers\CommentController;

Route::get('/list/posts', PostListController::class)->name('posts.list');

Route::middleware(['auth', 'role:admin|writer|moderator|user'])->group(function () {
  Route::resource('posts', PostController::class);
  Route::post('/post/{id}', [LikedPostsController::class, 'toggle'])->name('posts.toggle');
  Route::resource('comments', CommentController::class);
});
