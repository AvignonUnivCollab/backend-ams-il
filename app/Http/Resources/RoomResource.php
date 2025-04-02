<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
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
            'name' => $this->name,
            'thumbnail' => asset('storage/' . $this->thumbnail),
            'current_video' => new VideoResource($this->whenLoaded('currentVideo')),
            'host' => new UserResource($this->whenLoaded('host')),
            'playlist' => VideoResource::collection($this->whenLoaded('playlist')),
            'users' => UserResource::collection($this->whenLoaded('users')),
            'videos' => VideoResource::collection($this->whenLoaded('videos')),
            'messages' => MessageResource::collection($this->whenLoaded('messages')),
        ];
    }
}
