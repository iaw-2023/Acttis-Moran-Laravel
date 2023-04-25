<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Resources\TicketResource;

class TicketController extends Controller
{
    /**
     * Show all tickets from the matchgame
     * @param int $matchgameId
     */
    public function matchTickets($matchgameId)
    {
        if(!is_numeric($matchgameId) || $matchgameId < 1){
            return response()->json(['errors' => "The matchgame id specified is invalid."]);
        }

        $tickets = Ticket::where('matchgame_id',$matchgameId)->get();

        return TicketResource::collection($tickets);
    }


    /**
     * Display the specified resource.
     * @param int $ticketId
     */
    public function show($ticketId)
    {
        if(!is_numeric($ticketId) || $ticketId < 1){
            return response()->json(['errors' => "The ticket id specified is invalid."]);
        }

        $ticket = Ticket::findOrFail($ticketId);

        return new TicketResource($ticket);
    }
}
