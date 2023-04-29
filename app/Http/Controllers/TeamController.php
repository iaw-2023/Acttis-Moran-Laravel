<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Http\Resources\TeamResource;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidateException;

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

        try{
            $this->validateTeamID(request()->all());
        }
        catch (ValidateException $e) {
            return response()->json(["error" => $e->getMessage()], $e->getStatusCode());
        }

        $team = Team::findOrFail($teamId);

        return new TeamResource($team);
    }
}
