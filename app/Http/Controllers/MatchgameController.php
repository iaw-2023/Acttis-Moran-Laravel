<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matchgame;
use App\Models\Team;
use App\Models\Stadium;
use App\Models\TeamPlayingMatch;
use App\Http\Resources\MatchgameResource;
use App\Http\Controllers\Validation\DataValidator;
Use \Carbon\Carbon;


class MatchgameController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */
    public function index()
    {
        $matchgames = Matchgame::all();

        return MatchgameResource::collection($matchgames);
    }

    /**
     * Display a random reduced list of matchgames.
     * 
     * @OA\Get(
     *     path="/matchgame/example",
     *     tags={"matchgame"},
     *     summary="Devuelve un conjunto de diez Matchgame's aleatorios existentes.",
     *     @OA\Response(response="200", description="(OK) Se devolvio correctamente el/los matchgames deseados."),
     *     @OA\Response(response="400", description="(Bad Request) Los datos enviados son incorrectos o hay datos obligatorios no enviados"),
     *     @OA\Response(response="404", description="(NotFound) No se encontro informacion"),
     *     @OA\Response(response="500", description="Error en servidor")
     * )
     */
    public function example()
    {
        $matchgames = Matchgame::inRandomOrder()->limit(10)->get();

        return MatchgameResource::collection($matchgames);
    }

    /**
     * Display a listing of matches filter by team, stadium & date.
     *
     * @OA\Get(
     *     path="/matchgame/matchesby",
     *     tags={"matchgame"},
     *     summary="Devuelve la información de los matchgame's que depende de los parametros especificados.",
     *     @OA\Parameter(
     *         name="teamId",
     *         in="query",
     *         description="Identificador del Equipo que participa en/los Matchgame a obtener.",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="stadiumId",
     *         in="query",
     *         description="Identificador del Stadium donde se juega el/los Matchgame.",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="date",
     *         in="query",
     *         description="Fecha en la que se realiza el/los Matchgame.",
     *         required=false,
     *         @OA\Schema(type="string", format="date")
     *     ),
     *     @OA\Response(response="200", description="(OK) Se obtuvo correctamente el/los matchgames deseados."),
     *     @OA\Response(response="400", description="(Bad Request) Los datos enviados son incorrectos o hay datos obligatorios no enviados"),
     *     @OA\Response(response="404", description="(NotFound) No se encontro informacion"),
     *     @OA\Response(response="500", description="Error en servidor")
     * )
 */
    public function matchesBy(Request $request)
    {   
        $teamId = request()->query('teamId');
        $stadiumId = request()->query('stadiumId');
        $date = request()->query('date');

        $validator = DataValidator::validate($request->all(),[
            'teamId' => 'integer|min:1',
            'stadiumId' => 'integer|min:1',
            'date' => 'date|date_format:d-m-Y',
        ]);

        if($validator->fails()){
            return response()->json(["error" => $validator->errors()->first()], 400);
        }
    
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
     * 
     * @OA\Get(
     *     path="/matchgame/show/{matchgameId}",
     *     tags={"matchgame"},
     *     summary="Devuelve la información del matchgame que posee el ID proporcionado.",
     *     @OA\Parameter(
     *         name="matchgameId",
     *         in="path",
     *         description="Identificador del Matchgame a obtener.",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="(OK) Se obtuvo correctamente el matchgame deseado."),
     *     @OA\Response(response="400", description="(Bad Request) Los datos enviados son incorrectos o hay datos obligatorios no enviados"),
     *     @OA\Response(response="404", description="(NotFound) No se encontro informacion"),
     *     @OA\Response(response="500", description="Error en servidor")
     * )
    */
    public function show($matchgameId)
    {   
        request()->merge(['matchgameId' => request()->route('matchgameId')]);

        $validator = DataValidator::validateMatchgameID(request()->all());

        if($validator->fails()){
            return response()->json(["error" => $validator->errors()->first()], 400);
        }
        
        $matchgame = Matchgame::find($matchgameId);

        if(!$matchgame)
            return response()->json(["error" => "Matchgame not found."], 404);
        
        return new MatchgameResource($matchgame);
    }
}
