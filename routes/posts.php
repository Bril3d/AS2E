<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostListController;
use App\Http\Controllers\LikedPostsController;
use App\Http\Controllers\CommentController;

Route::get('/feed', PostListController::class)->name('feed.list');

Route::middleware(['auth'])->group(function () {
  Route::resource('posts', PostController::class);
  Route::post('/publish/{slug}', [PostController::class, 'publish'])->name('posts.publish');
  Route::post('/update/post', [PostController::class, 'update'])->name('posts.update');
  Route::post('/post/{id}', [LikedPostsController::class, 'toggle'])->name('posts.toggle');
  Route::resource('comments', CommentController::class);
});
