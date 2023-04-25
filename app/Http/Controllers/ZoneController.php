<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zone;
use App\Models\Ticket;
use App\Http\Resources\ZoneResource;

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
     */
    public function stadiumZones($stadiumId) {

        if(!is_numeric($stadiumId) || $stadiumId < 1){
            return response()->json(['errors' => "The stadium id specified is invalid."]);
        }

        $zones = Zone::where('stadium_id', $stadiumId)->get();

        return ZoneResource::collection($zones);
    }

    /**
     * Display the specified resource.
     * @param int $zoneId
     */
    public function show($zoneId)
    {
        if(!is_numeric($zoneId) || $zoneId < 1){
            return response()->json(['errors' => "The zone id specified is invalid."]);
        }

        $zone = Zone::findOrFail($zoneId);

        return new ZoneResource($zone);
    }

}
