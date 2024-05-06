<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'description' => $this->description,
            'body' => $this->body,
            'slug' => $this->slug,
            'image' => $this->image ? '/storage/' .  $this->image : null,
            'created_at' => $this->created_at->format('d/m/Y'),
            'user' => $this->author,
        ];
    }
}
