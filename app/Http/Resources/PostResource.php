<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'slug' => $this->slug,
            'image' => $this->image ? '/storage/feed/' .  $this->image : null,
            'created_at' => $this->created_at->format('d/m/Y'),
            'user' => $this->user,
            'liked' => $this->isAuthUserLikedPost(),
            'likes' => $this->likes->count(),
            'comments' => CommentResource::collection($this->comments),
        ];
    }
}
