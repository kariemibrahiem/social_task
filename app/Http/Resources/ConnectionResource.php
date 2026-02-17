<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConnectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "sender" => new UserResource($this->whenLoaded('sender')),
            "receiver" => new UserResource($this->whenLoaded('receiver')),
            "status" => $this->status,  
            "is_sender" => $this->sender_id == auth('user-api')->id(),
            "is_receiver" => $this->receiver_id == auth('user-api')->id(),
            "created_at" => $this->created_at,
        ];
    }
}
