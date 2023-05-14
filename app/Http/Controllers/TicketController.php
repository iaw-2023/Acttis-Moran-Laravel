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
