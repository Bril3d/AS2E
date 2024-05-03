<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class PostListController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $posts = Post::where('published', true)->latest()->cursorPaginate(setting('pagination_limit'));

        if($request->wantsJson()){
            return PostResource::collection($posts);
        }

        return Inertia::render('Posts/Index', [
            'posts' => PostResource::collection($posts),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }
}
