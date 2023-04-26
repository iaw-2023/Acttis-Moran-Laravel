<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matchgame;
use App\Models\Team;
use App\Models\Stadium;
use App\Models\TeamPlayingMatch;
use App\Http\Resources\MatchgameResource;
Use \Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

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
        $matchgames = Matchgame::inRandomOrder()->limit(10)->get();

        return MatchgameResource::collection($matchgames);
    }

    /**
     * Display a listing of matches filter by team, stadium & date.
     */
    public function matchesBy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'teamId' => 'integer|min:1',
            'stadiumId' => 'integer|min:1',
            'date' => 'date',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->first()], 400);
        }
    
        $teamId = request()->query('teamId');
        $stadiumId = request()->query('stadiumId');
        $date = request()->query('date');
        
        $matchgamesToFilter = collect();
        //If there is no coincidence for one filter, the other filters doesnt apply
        $noCoincidence = false;

        if($teamId != null && !$noCoincidence){
            $matchgamesToFilter = $this->filterByTeam($matchgamesToFilter, $teamId);
            if($matchgamesToFilter->isEmpty())
                $noCoincidence = true;
        }
        if($stadiumId != null && !$noCoincidence){
            $matchgamesToFilter = $this->filterByStadium($matchgamesToFilter, $stadiumId);
            if($matchgamesToFilter->isEmpty())
                $noCoincidence = true;
        }
        if($date != null && !$noCoincidence){
            $matchgamesToFilter = $this->filterByDate($matchgamesToFilter, $date);
            if($matchgamesToFilter->isEmpty())
                $noCoincidence = true;
        }
        
        return MatchgameResource::collection($matchgamesToFilter);
    }

    /**
     * Display a listing of matches that the parametrized team plays.
     * 
     * @param collection $matchgamesToFilter
     * @param int $teamId
     */
    protected function filterByTeam($matchgamesToFilter, $teamId)
    {
        $matchgamesToReturn = collect();

        if($matchgamesToFilter->isEmpty()){
            $teams_playing_matches = TeamPlayingMatch::where('team_id',$teamId)->get();
            foreach($teams_playing_matches as $team_match){
                $match = $team_match->matchgame;
                $matchgamesToReturn->push($match);
                
            }
        }
        else {
            foreach($matchgamesToFilter as $matchgame) {
                $teamsPlaying = $matchgame->teamsPlayingMatch;
                if(($teamsPlaying[0]->team_id == $teamId) || ($teamsPlaying[1]->team_id == $teamId))
                    $matchgamesToReturn->push($matchgame);
            }
        }

        return $matchgamesToReturn;
    }

    /**
     * Display a listing of matches that are played on the stadium parametrized.
     * 
     * @param collection $matchgamesToFilter
     * @param int $stadiumId
     */
    protected function filterByStadium($matchgamesToFilter, $stadiumId)
    {
        $matchgamesToReturn = collect();
        
        if($matchgamesToFilter->isEmpty()){
            $matchgamesToReturn = Matchgame::where('stadium_id', $stadiumId)->get();
        }
        else {
            $matchgamesToReturn = $matchgamesToFilter->where('stadium_id', $stadiumId);
        }
        
        return $matchgamesToReturn;
    }

    /**
     * Display a listing of matches that are played on the date parametrized.
     * 
     * @param collection $matchgamesToFilter
     * @param string $date
     */
    protected function filterByDate($matchgamesToFilter, $date)
    {
        $matchgamesToReturn = collect();

        if($matchgamesToFilter->isEmpty()){
            $matchgamesToReturn = Matchgame::where('played_on_date', $date)->get();
        }
        else {
            $matchgamesToReturn = $matchgamesToFilter->where('played_on_date',$date);
        }

        return $matchgamesToReturn;
    }

    /**
     * Display the specified resource.
     * 
     * @param int $matchgameId
     */
    public function show($matchgameId)
    {   
        request()->merge(['matchgameId' => request()->route('matchgameId')]);

        $validator = Validator::make(request()->all(), [
            'matchgameId' => 'required|integer|min:1',
        ]);

        if($validator->fails()){
            return response()->json(['error' => 'Invalid Matchgame ID.'], 400);
        }
        
        $matchgame = Matchgame::find($matchgameId);
        
        if($matchgame == null)
            return response()->json(['error' => 'Matchgame not found.'], 404);
        
        return new MatchgameResource($matchgame);
    }
}
