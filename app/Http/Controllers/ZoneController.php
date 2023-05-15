<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zone;
use App\Models\Ticket;
use App\Http\Resources\ZoneResource;
use App\Http\Controllers\Validation\DataValidator;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $zones = Zone::all();

        return ZoneResource::collection($zones);
    }

    /**
     * Returns a listing of the zones asociated with stadium
     * @param int $stadiumId
     *
     * @OA\Get(
     *     path="/zone/stadiumzones/{stadiumId}",
     *     tags={"zone"},
     *     summary="Devuelve la informacion de todas las Zone's asociadas al Stadium especificado.",
     *     @OA\Parameter(
     *         name="stadiumId",
     *         in="path",
     *         description="Identificador del Stadium del cual se quieren obtener las Zonas asociadas.",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="(OK) Se obtuvo correctamente el/las Zone's deseadas."
     *     ),
     *     @OA\Response(response="400", description="(Bad Request) Los datos enviados son incorrectos o hay datos obligatorios no enviados"),
     *     @OA\Response(response="404", description="(NotFound) No se encontro informacion"),
     *     @OA\Response(response="500", description="Error en servidor")
     * )
    */
    public function stadiumZones($stadiumId) {

        request()->merge(['stadiumId' => request()->route('stadiumId')]);

        $validator = DataValidator::validateStadiumID(request()->all());

        if($validator->fails()){
            return response()->json(["error" => $validator->errors()->first()], 400);
        }

        $zones = Zone::where('stadium_id', $stadiumId)->get();

        if($zones->isEmpty())
            return response()->json(["error" => "Zones not found."], 404);

        return ZoneResource::collection($zones);   
    }

    /**
     * Display the specified resource.
     * @param int $zoneId
     * 
     * @OA\Get(
     *     path="/zone/show/{zoneId}",
     *     summary="Devuelve la informacion del Zone que posee el ID proporcionado.",
     *     tags={"zone"},
     *     @OA\Parameter(
     *         name="zoneId",
     *         in="path",
     *         description="Identificador del Zone a obtener.",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="(OK) Se obtuvo correctamente la zona deseada.",
     *     ),
     *     @OA\Response(response="400", description="(Bad Request) Los datos enviados son incorrectos o hay datos obligatorios no enviados"),
     *     @OA\Response(response="404", description="(NotFound) No se encontro informacion"),
     *     @OA\Response(response="500", description="Error en servidor")
     * )
    */
    public function show($zoneId)
    {
        request()->merge(['zoneId' => request()->route('zoneId')]);

        $validator = DataValidator::validateZoneID(request()->all());

        if($validator->fails()){
            return response()->json(["error" => $validator->errors()->first()], 400);
        }

        $zone = Zone::find($zoneId);

        if(!$zone)
            return response()->json(["error" => "Zone not found."], 404);

        return new ZoneResource($zone);
    }

}
