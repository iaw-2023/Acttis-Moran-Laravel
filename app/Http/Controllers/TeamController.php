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
     * 
     * @OA\Get(
     *     path="/team/index",
     *     tags={"team"},
     *     summary="Devuelve la informacion de todos los Team's existentes.",
     *     @OA\Response(
     *         response="200",
     *         description="(OK) Se obtuvo correctamente el/los team deseados."
     *     ),
     *     @OA\Response(response="400", description="(Bad Request) Los datos enviados son incorrectos o hay datos obligatorios no enviados"),
     *     @OA\Response(response="404", description="(NotFound) No se encontro informacion"),
     *     @OA\Response(response="500", description="Error en servidor")
     * )
    */
    public function index()
    {
        $teams = Team::all();

        return TeamResource::collection($teams);
    }

    /**
     * Display the specified resource.
     * @param int $teamId
     * 
     * @OA\Get(
     *     path="/team/show/{teamId}",
     *     tags={"team"},
     *     summary="Devuelve la informacion del Team que posee el ID proporcionado.",
     *     @OA\Parameter(
     *         name="teamId",
     *         in="path",
     *         description="Identificador del Team a obtener.",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="(OK) Se obtuvo correctamente el team deseado."
     *     ),
     *     @OA\Response(response="400", description="(Bad Request) Los datos enviados son incorrectos o hay datos obligatorios no enviados"),
     *     @OA\Response(response="404", description="(NotFound) No se encontro informacion"),
     *     @OA\Response(response="500", description="Error en servidor")
     * )
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
