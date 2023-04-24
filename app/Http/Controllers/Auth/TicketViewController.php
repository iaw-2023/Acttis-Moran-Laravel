<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TicketViewController extends HomeController
{
    public function index()
    {
        $tickets = Ticket::all();
        return view('tickets', ['tickets' => $tickets]);
    }

    public function delete(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->back()->with('success', 'Ticket deleted successfully.');
    }

    public function update(Request $request, Ticket $ticket)
    {
        $ticket->zone_id = $request->zone_id;
        $ticket->base_price = $request->base_price;
        $ticket->matchgame_id = $request->matchgame_id;
        $ticket->save();
        return redirect()->back()->with('success', 'Ticket updated successfully.');
    }

    public function store(Request $request)
    {
        $ticket = new Ticket;
        $ticket->zone_id = $request->zone_id;
        $ticket->base_price = $request->base_price;
        $ticket->matchgame_id = $request->matchgame_id;

        try {
            $ticket->save();
            return redirect()->back()->with('success', 'Ticket created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ticket creation failed: ' . $e->getMessage());
        }
    }
}
