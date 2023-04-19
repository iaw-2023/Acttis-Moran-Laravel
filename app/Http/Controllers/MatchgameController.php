<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matchgame;
use App\Models\Team;
use App\Models\Stadium;
use App\Models\TeamPlayingMatch;
use App\Http\Resources\MatchgameResource;
Use \Carbon\Carbon;

class MatchgameController extends Controller
{
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
        $matchgames = Matchgame::inRandomOrder()->limit(5)->get();

        return MatchgameResource::collection($matchgames);
    }

    /**
     * Display a listing of matches that the parametrized team plays.
     * 
     * @param int $teamId
     */
    public function matchesByTeam($teamId)
    {
        $teams_playing_matches = TeamPlayingMatch::where('team_id',$teamId)->get();
        $matchgames = collect();
        foreach($teams_playing_matches as $team_match){
            $match = $team_match->matchgame;
            $matchgames->push($match);
        }

        return MatchgameResource::collection($matchgames);
    }

    /**
     * Display a listing of matches that are played on the stadium parametrized.
     * 
     * @param int $stadiumId
     */
    public function matchesByStadium($stadiumId)
    {
        $matchgames = MatchGame::where('stadium_id',$stadiumId)->get();
        
        return MatchgameResource::collection($matchgames);
    }

    /**
     * Display a listing of matches that are played on the date parametrized.
     * 
     * @param int $year
     * @param int $month
     * @param int $day
     */
    public function matchesByDate($year, $month, $day)
    {
        $matchgames = Matchgame::where('played_on_date',"{$year}-{$month}-{$day}")->get();
        
        return MatchgameResource::collection($matchgames);
    }

    /**
     * Display a listing of matches that are played on the date parametrized and played by the team specified.
     * 
     * @param int $teamId
     * @param int $year
     * @param int $month
     * @param int $day
     */
    public function matchesByDateAndTeam($teamId, $year, $month, $day)
    {
        $teams_playing_matches = TeamPlayingMatch::where('team_id',$teamId)->get();
        $matchgamesByTeam = collect();
        foreach($teams_playing_matches as $team_match){
            $match = $team_match->matchgame;
            $matchgamesByTeam->push($match);
        }
        
        $matchgamesByTeamAndDate = $matchgamesByTeam->where('played_on_date',"{$year}-{$month}-{$day}");

        return MatchgameResource::collection($matchgamesByTeamAndDate);
    }

    /**
     * Display a listing of matches that are played on the date parametrized and played in the stadium specified.
     * 
     * @param int $stadiumId
     * @param int $year
     * @param int $month
     * @param int $day
     */
    public function matchesByDateAndStadium($stadiumId, $year, $month, $day)
    {
        $matchgamesByStadiumAndDate = MatchGame::where('stadium_id',$stadiumId)->where('played_on_date',"{$year}-{$month}-{$day}")->get();

        return MatchgameResource::collection($matchgamesByStadiumAndDate);
    }

    /**
     * Display a listing of matches that are played on the date parametrized, played by the team specified, in the stadium specified.
     * 
     * @param int $teamId
     * @param int $stadiumId
     * @param int $year
     * @param int $month
     * @param int $day
     */
    public function matchesByDateTeamStadium($teamId, $stadiumId, $year, $month, $day)
    {
        $teams_playing_matches = TeamPlayingMatch::where('team_id',$teamId)->get();
        $matchgamesByTeam = collect();
        foreach($teams_playing_matches as $team_match){
            $match = $team_match->matchgame;
            $matchgamesByTeam->push($match);
        }

        $matchgamesByTeamInStadiumAndDate = $matchgamesByTeam->where('stadium_id',$stadiumId)->where('played_on_date',"{$year}-{$month}-{$day}");

        return MatchgameResource::collection($matchgamesByTeamInStadiumAndDate);
    }

    /**
     * Display the specified resource.
     * 
     * @param int $matchgameId
     */
    public function show($matchgameId)
    {
        $matchgame = Matchgame::findOrFail($matchgameId);

        return new MatchgameResource($matchgame);
    }
}
