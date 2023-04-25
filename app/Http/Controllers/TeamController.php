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
            'teamId' => 'required|exists:teams,id',
        ]);

        if($validator->fails()){
            return response()->json(['error' => 'Invalid Team ID.']);
        }

        $team = Team::findOrFail($teamId);

        return new TeamResource($team);
    }
}
