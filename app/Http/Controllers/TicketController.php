<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Resources\TicketResource;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidateException;

class TicketController extends Controller
{
    /**
     * Show all tickets from the matchgame
     * @param int $matchgameId
     */
    public function matchTickets($matchgameId)
    {
        request()->merge(['matchgameId' => request()->route('matchgameId')]);

        try{
            $this->validateMatchgameID(request()->all());
        }
        catch (ValidateException $e) {
            return response()->json(["error" => $e->getMessage()], $e->getStatusCode());
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

        try{
            $this->validateTicketID(request()->all());
        }
        catch (ValidateException $e) {
            return response()->json(["error" => $e->getMessage()], $e->getStatusCode());
        }

        $ticket = Ticket::findOrFail($ticketId);

        return new TicketResource($ticket);
    }
}
