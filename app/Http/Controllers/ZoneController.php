<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zone;
use App\Models\Ticket;
use App\Http\Resources\ZoneResource;
use App\Http\Resources\TicketResource;

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
     * Show all tickets of the zone
     */
    public function zoneTickets($id) {
        $tickets = Ticket::where('zone_id',$id)->get();

        return TicketResource::collection($tickets); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $zone = Zone::findOrFail($id);

        return new ZoneResource($zone);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
