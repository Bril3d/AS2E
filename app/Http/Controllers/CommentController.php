<?php

namespace App\Http\Controllers;

use App\Events\CommentPosted;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CommentController extends Controller
{

    public function index(Request $request)
    {
        if ($request->user()->isAdmin()) {
            $comments = Comment::orderBy('created_at', 'desc')->paginate(setting('pagination_limit'));
            return Inertia::render('Comments/Comments', ['comments' => CommentResource::collection($comments)]);
        } else {
            $comments = Comment::where('user_id', $request->user()->id)->orderBy('created_at', 'desc')->paginate(setting('pagination_limit'));
            return Inertia::render('Comments/Comments', ['comments' => CommentResource::collection($comments)]);
        }
    }

    public function edit(string $id)
    {
        $comment = Comment::findOrFail($id);

        return Inertia::render('Comments/Edit', ['comment' => new CommentResource($comment)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'post_id' => 'required|exists:posts,id'
        ]);

        $comment = Comment::create([
            'content' => $request->input('content'),
            'post_id' => $request->input('post_id'),
            'user_id' => auth()->id(),
        ]);

        broadcast(new CommentPosted($comment, $comment->post->user_id))->toOthers();
        
        Notification::create([
            'post_id' => $comment->post_id,
            'user_id' => $comment->post->user_id,
            'message' => Auth::user()->name . ' commented on your post!',
        ]);

        if ($request->wantsJson()) {
            return new CommentResource($comment);
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $comment->update([
            'content' => $request->input('content')
        ]);

        return Redirect::route('posts.show', $comment->post);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back();
    }
}
