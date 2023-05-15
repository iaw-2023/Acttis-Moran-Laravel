<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Resources\TicketResource;
use App\Http\Controllers\Validation\DataValidator;

class TicketController extends Controller
{

    /**
     * Show all tickets from the matchgame
     * @param int $matchgameId
     * 
     * @OA\Get(
     *     path="/ticket/matchtickets/{matchgameId}",
     *     summary="Devuelve la informacion de todos los Ticket's asociados al Matchgame especificado.",
     *     tags={"ticket"},
     *     @OA\Parameter(
     *         name="matchgameId",
     *         in="path",
     *         description="Identificador del Matchgame del cual se quieren obtener los tickets asociados.",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="(OK) Se obtuvo correctamente el/los tickets deseados."
     *     ),
     *     @OA\Response(response="400", description="(Bad Request) Los datos enviados son incorrectos o hay datos obligatorios no enviados"),
     *     @OA\Response(response="404", description="(NotFound) No se encontro informacion"),
     *     @OA\Response(response="500", description="Error en servidor")
     * )
    */
    public function matchTickets($matchgameId)
    {
        request()->merge(['matchgameId' => request()->route('matchgameId')]);

        $validator = DataValidator::validateMatchgameID(request()->all());

        if($validator->fails()){
            return response()->json(["error" => $validator->errors()->first()], 400);
        }

        $tickets = Ticket::where('matchgame_id',$matchgameId)->get();

        if($tickets->isEmpty())
            return response()->json(["error" => "Tickets not found."], 404);

        return TicketResource::collection($tickets);
    }


    /**
     * Display the specified resource.
     * @param int $ticketId
     * 
     * @OA\Get(
     *     path="/ticket/show/{ticketId}",
     *     summary="Devuelve la informacion del Ticket que posee el ID proporcionado.",
     *     tags={"ticket"},
     *     @OA\Parameter(
     *         name="ticketId",
     *         in="path",
     *         description="Identificador del Ticket a obtener.",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="(OK) Se obtuvo correctamente el ticket deseado."
     *     ),
     *     @OA\Response(response="400", description="(Bad Request) Los datos enviados son incorrectos o hay datos obligatorios no enviados"),
     *     @OA\Response(response="404", description="(NotFound) No se encontro informacion"),
     *     @OA\Response(response="500", description="Error en servidor")
     * )
    */
    public function show($ticketId)
    {
        request()->merge(['ticketId' => request()->route('ticketId')]);

        $validator = DataValidator::validateTicketID(request()->all());

        if($validator->fails()){
            return response()->json(["error" => $validator->errors()->first()], 400);
        }

        $ticket = Ticket::find($ticketId);

        if(!$ticket)
            return response()->json(["error" => "Ticket not found."], 404);

        return new TicketResource($ticket);
    }
}
