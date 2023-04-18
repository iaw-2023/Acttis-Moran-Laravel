<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matchgame;
use App\Models\Team;
use App\Models\Stadium;
use App\Models\TeamPlayingMatch;
use App\Http\Resources\MatchgameResource;

class MatchgameController extends Controller
{
    public function __construct()
    {
        $this->middleware('api');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matchgames = Matchgame::all();

        return MatchgameResource::collection($matchgames);
    }

    /**
     * Display a random reduced list of matchgames.
     */
    public function example()
    {
        $matchgames = Matchgame::take(5)->get();

        return MatchgameResource::collection($matchgames);
    }

    /**
     * Display a listing of matches that the team plays.
     *
     * @param int $id
     */
    public function matchesByTeam($id)
    {
        $teams_playing_matches = TeamPlayingMatch::where('team_id',$id)->get();
        $matchgames = collect();
        foreach($teams_playing_matches as $team_match){
            $match = $team_match->matchgame;
            $matchgames->push($match);
        }

        return MatchgameResource::collection($matchgames);
    }

    /**
     * Display a listing of matches that are played on the stadium.
     *
     * @param int $id
     */
    public function matchesByStadium($id)
    {
        $matchgames = MatchGame::where('stadium_id',$id)->get();

        return MatchgameResource::collection($matchgames);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $matchgame = Matchgame::findOrFail($id);

        return new MatchgameResource($matchgame);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
