<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostListController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        if ($request->user()->isAdmin()) {
            $posts = Post::orderBy('created_at', 'desc')->get();
        } else {
            $posts = Post::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();
        }
        return Inertia::render('Posts/Posts', ['posts' => PostResource::collection($posts)]);
    }
}
