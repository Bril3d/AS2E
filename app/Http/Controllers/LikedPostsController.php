<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class LikedPostsController extends Controller
{
    public function toggle($id)
    {
        $post = Post::find($id);

        $post->likes()->toggle(auth()->id());

        return back();
    }
}
