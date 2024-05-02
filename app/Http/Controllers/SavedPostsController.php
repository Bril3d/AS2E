<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SavedPostsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $auth = $request->user();

        $posts = $auth->savedPosts()->latest()->paginate(15);

        if ($request->wantsJson()) {
            return PostResource::collection($posts);
        }

        return Inertia::render('Posts/SavedPosts', [
            'posts' => PostResource::collection($posts)
        ]);
    }
}
