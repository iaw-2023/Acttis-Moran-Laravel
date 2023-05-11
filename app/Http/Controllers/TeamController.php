<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Http\Resources\TeamResource;
use App\Http\Controllers\Validation\DataValidator;

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

        $validator = DataValidator::validateTeamID(request()->all());

        if($validator->fails()){
            return response()->json(["error" => $validator->errors()->first()], 400);
        }

        $team = Team::find($teamId);

        if(!$team)
        return response()->json(["error" => "Not found Team."], 404);

        return new TeamResource($team);
    }
}
