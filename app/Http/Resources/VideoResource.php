<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
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
            'is_youtube' => $this->is_youtube == 0 ? false : true,
            'video' => $this->is_youtube == 0 ? asset('storage/' . $this->url) : $this->url,
            'thumbnail' => asset('storage/' . $this->thumbnail),
        ];
    }
}
