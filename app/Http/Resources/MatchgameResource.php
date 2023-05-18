<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MatchgameResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'matchgame_id' => $this->id,
            'played_on_date' => $this->played_on_date,
            'played_on_time' => $this->played_on_time,
            'stadium' => new StadiumResource($this->stadium),
            'team_one' => new TeamPlayingMatchResource($this->teamsPlayingMatch[0]),
            'team_two' => new TeamPlayingMatchResource($this->teamsPlayingMatch[1]),
        ];
    }
}
