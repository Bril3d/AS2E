<?php

namespace App\Events;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;

class CommentPosted implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $comment;
    public $postOwnerId;

    public function __construct(Comment $comment, $postOwnerId)
    {
        $this->comment = $comment;
        $this->postOwnerId = $postOwnerId;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('comments.' . $this->postOwnerId);
    }

    public function broadcastWith()
    {
        return ['comment' => new CommentResource($this->comment)];
    }
}
