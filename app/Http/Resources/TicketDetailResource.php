<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ticket_detail_id' => $this->id,
            'ticket_quantity' => $this->ticket_quantity,
            'ticket_associated' => new TicketResource($this->ticket),
        ];
    }
}
