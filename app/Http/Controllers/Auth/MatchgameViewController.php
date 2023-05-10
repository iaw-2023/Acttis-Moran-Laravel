<?php

namespace App\Http\Controllers\Auth;

use App\Http\Resources\ZoneResource;
use App\Models\Matchgame;
use App\Models\TeamPlayingMatch;
use App\Models\Stadium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class MatchgameViewController extends HomeController
{
    public function index()
    {
        $matchgames = MatchGame::all();
        $team_playing_match = TeamPlayingMatch::all();
        return view('matchgames',
                [
                'matchgames'=>$matchgames,
                'team_playing_match'=>$team_playing_match
                ]
        );
    }

    public function delete($matchgameId)
    {
        $matchgame = Matchgame::find($matchgameId);
        $matchgame->delete();
        
        return redirect()->back()->with('success', 'Ticket deleted successfully.');
    }


}
