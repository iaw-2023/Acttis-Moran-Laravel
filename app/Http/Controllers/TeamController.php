<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Http\Resources\TeamResource;
use Illuminate\Support\Facades\Validator;

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
        request()->merge(['teamId' => request()->route('teamId')]);

        $validator = Validator::make(request()->all(), [
            'teamId' => 'required|integer|min:1',
        ]);

        if($validator->fails()){
            return response()->json(['error' => 'Invalid Team ID.'], 400);
        }

        $team = Team::find($teamId);

        if($team == null)
            return response()->json(['error' => 'Team not found.'], 404);

        return new TeamResource($team);
    }
}
