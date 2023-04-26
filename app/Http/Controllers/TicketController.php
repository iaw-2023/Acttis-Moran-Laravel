<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Resources\TicketResource;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    /**
     * Show all tickets from the matchgame
     * @param int $matchgameId
     */
    public function matchTickets($matchgameId)
    {
        request()->merge(['matchgameId' => request()->route('matchgameId')]);

        $validator = Validator::make(request()->all(), [
            'matchgameId' => 'required|integer|min:1',
        ]);

        if($validator->fails()){
            return response()->json(['error' => 'Invalid Matchgame ID.'], 400);
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
        request()->merge(['ticketId' => request()->route('ticketId')]);

        $validator = Validator::make(request()->all(), [
            'ticketId' => 'required|integer|min:1',
        ]);

        if($validator->fails()){
            return response()->json(['error' => 'Invalid Ticket ID.'], 400);
        }

        $ticket = Ticket::find($ticketId);

        if($ticket == null)
            return response()->json(['error' => 'Ticket not found.'], 404);

        return new TicketResource($ticket);
    }
}
