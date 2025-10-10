<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowtimeResource extends JsonResource
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
            'time' => optional($this->time)->toIso8601String(),
            'movie' => new MovieResource($this->whenLoaded('movie')),
            'location' => new LocationResource($this->whenLoaded('location')),
        ];
    }
}
