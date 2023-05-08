<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\MatchgameResource;
use App\Http\Resources\ZoneResource;
use App\Models\Matchgame;
use App\Models\TeamPlayingMatch;
use App\Models\Ticket;
use App\Models\Zone;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TicketViewController extends HomeController
{
    public function index()
    {
        $tickets = Ticket::all();
        $zones = Zone::all();
        $matchgames = MatchGame::all();
        $team_playing_match = TeamPlayingMatch::all();
        return view('tickets',
                ['tickets' => $tickets,
                'zones'=>$zones,
                'matchgames'=>$matchgames,
                'team_playing_match'=>$team_playing_match
                ]
        );
    }

    public function delete(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->back()->with('success', 'Ticket deleted successfully.');
    }

    public function update(Request $request, Ticket $ticket)
    {
        $ticket->zone_id = $request->zone_id;
        $ticket->base_price = $request->base_price;
        $ticket->matchgame_id = $request->matchgame_id;
        $ticket->save();
        return redirect()->back()->with('success', 'Ticket updated successfully.');
    }

    public function store(Request $request)
    {

        $ticket = new Ticket;
        $ticket->zone_id = $request->zone_id;
        $ticket->base_price = $request->base_price;
        $ticket->matchgame_id = $request->matchgame_id;

        try {
            $ticket->save();
            return redirect()->back()->with('success', 'Ticket created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ticket creation failed: ' . $e->getMessage());
        }
    }

    public static function getMatchGameData() {
        $matchgames = \App\Models\MatchGame::all();

        $data = [];

        foreach ($matchgames as $matchgame) {
            $teams_playing_match = \App\Models\TeamPlayingMatch::where('matchgame_id', $matchgame->id)->get();
            $home_team = null;
            $away_team = null;

            foreach ($teams_playing_match as $team_playing_match) {
                if ($team_playing_match->condition == 'home') {
                    $home_team_id = $team_playing_match->team_id;
                    $home_team = \App\Models\Team::where('id', $home_team_id)->first();
                } else {
                    $away_team_id = $team_playing_match->team_id;
                    $away_team = \App\Models\Team::where('id', $away_team_id)->first();
                }
            }

            $data[] = [
                'id' => $matchgame->id,
                'home_team_name' => $home_team->team_name,
                'away_team_name' => $away_team->team_name
            ];
        }

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param int $matchgameId
     */
    public function showZonesByMatchGameID($matchgameId)
    {
        $matchgame = Matchgame::findOrFail($matchgameId);
        $stadium_id = $matchgame->stadium_id;
        $zones = Zone::where('stadium_id',$stadium_id)->get();

        return ZoneResource::collection($zones);
    }

    public function showZones()
    {
        $zones = Zone::all();
        return ZoneResource::collection($zones);
    }

    public static function getZone($zones,$zoneId){
        $zone = $zones->where('id',$zoneId)->first();
        return $zone;
    }
}
