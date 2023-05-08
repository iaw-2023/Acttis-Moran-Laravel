<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StadiumResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'stadium_id' => $this->id,
            'stadium_name' => $this->stadium_name,
            'capacity' => $this->capacity,
            'located_on_city' => $this->located_on_city,
        ];
    }
}
