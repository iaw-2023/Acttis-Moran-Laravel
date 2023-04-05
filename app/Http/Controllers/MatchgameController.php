<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matchgame;
use App\Models\Team;
use App\Models\Stadium;

class MatchgameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matchgames = Matchgame::select('id','played_on_date','played_on_time','stadium_id')->get();

        return $matchgames;
    }

    protected function obtainTeamsOfMatchGameById($matchgame_id){
        return $teams_playing_match = TeamPlayingMatch::select('team_id','condition')->where('matchgame_id',$matchgame_id)->get();

    }

    protected function obtainStadiumOfMatchGameById($stadium_id){
        return $match_stadium = Stadium::select('stadium_name','located_on_city')->where('id', $stadium_id);
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
        return Matchgame::select('played_on_date','played_on_time','stadium_id')->findOrFail($id);
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
