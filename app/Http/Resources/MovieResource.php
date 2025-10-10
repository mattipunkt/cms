<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'year' => $this->year,
            'director' => $this->director,
            'actors' => $this->actors,
            'genre' => $this->genre,
            'country' => $this->country,
            'description' => $this->description,
            'image' => $this->image,
            'trailer_url' => $this->trailer_url,
            'runtime' => $this->runtime,
        ];
    }
}
