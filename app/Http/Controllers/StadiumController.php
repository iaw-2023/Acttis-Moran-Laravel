<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stadium;
use App\Http\Resources\StadiumResource;
use App\Http\Controllers\Validation\DataValidator;

class StadiumController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @OA\Get(
     *     path="/stadium/index",
     *     tags={"stadium"},
     *     summary="Devuelve la informacion de todos los Stadium's existentes.",
     *     @OA\Response(
     *         response=200,
     *         description="(OK) Se obtuvo correctamente el/los stadiums deseados."
     *     ),
     *     @OA\Response(response="400", description="(Bad Request) Los datos enviados son incorrectos o hay datos obligatorios no enviados"),
     *     @OA\Response(response="404", description="(NotFound) No se encontro informacion"),
     *     @OA\Response(response="500", description="Error en servidor")
     * )
    */
    public function index()
    {
        $stadiums = Stadium::all();

        return StadiumResource::collection($stadiums);
    }


    /**
     * Display the specified resource.
     * @param int $stadiumId
     * 
     * @OA\Get(
     *     path="/stadium/show/{stadiumId}",
     *     tags={"stadium"},
     *     summary="Devuelve la informacion del stadium que posee el ID proporcionado.",
     *     @OA\Parameter(
     *         name="stadiumId",
     *         in="path",
     *         description="Identificador del Stadium a obtener.",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="(OK) Se obtuvo correctamente el stadium deseado."
     *     ),
     *     @OA\Response(response="400", description="(Bad Request) Los datos enviados son incorrectos o hay datos obligatorios no enviados"),
     *     @OA\Response(response="404", description="(NotFound) No se encontro informacion"),
     *     @OA\Response(response="500", description="Error en servidor")
     * )
    */
    public function show($stadiumId)
    {
        request()->merge(['stadiumId' => request()->route('stadiumId')]);

        $validator = DataValidator::validateStadiumID(request()->all());

        if($validator->fails()){
            return response()->json(["error" => $validator->errors()->first()], 400);
        }

        $stadium = Stadium::find($stadiumId);

        if(!$stadium)
            return response()->json(["error" => "Not found Stadium."], 404);

        return new StadiumResource($stadium);
    }

}
