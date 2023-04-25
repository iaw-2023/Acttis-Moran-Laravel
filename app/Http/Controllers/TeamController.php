<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Http\Resources\TeamResource;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::all();

        return TeamResource::collection($teams);
    }

    /**
     * Display the specified resource.
     * @param int $teamId
     */
    public function show($teamId)
    {
        if(!is_numeric($teamId) || $teamId < 1){
            return response()->json(['errors' => "The team id specified is invalid."]);
        }

        $team = Team::findOrFail($teamId);

        return new TeamResource($team);
    }
}
