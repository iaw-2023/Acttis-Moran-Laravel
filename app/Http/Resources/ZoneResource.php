<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ZoneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'zone_id' => $this->id,
            'stadium_location' => $this->stadium_location,
            'price_multiplier' => $this->price_multiplier,
        ];
    }
}