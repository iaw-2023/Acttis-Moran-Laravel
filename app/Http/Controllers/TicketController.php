<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketControllerController extends HomeController
{
    /**
     * Show all tickets from the matchgame
     * @param int $matchgameId
     */
    public function matchTickets($matchgameId) {

        $tickets = Ticket::where('matchgame_id',$matchgameId)->get();

        return TicketResource::collection($tickets);
    }


    /**
     * Display the specified resource.
     * @param int $ticketId
     */
    public function show(string $ticketId)
    {
        $ticket = Ticket::findOrFail($ticketId);

        return new TicketResource($ticket);
    }
}
