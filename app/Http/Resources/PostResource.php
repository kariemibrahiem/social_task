<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'image' => url($this->image),
            'created_at' => $this->created_at,
            "user" => new UserResource($this->whenLoaded('user')),
            "comments" => CommentResource::collection($this->whenLoaded('comments')),
            "likes_count" => $this->likes->count(),
            "comments_count" => $this->comments->count(),
            "is_liked" => $this->likes->contains('user_id', auth('user-api')->id()),
            "is_commented" => $this->comments->contains('user_id', auth('user-api')->id()),
        ];
    }
}
