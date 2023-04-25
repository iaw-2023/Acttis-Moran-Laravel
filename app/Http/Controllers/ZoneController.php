<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zone;
use App\Models\Ticket;
use App\Http\Resources\ZoneResource;
use Illuminate\Support\Facades\Validator;

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

        request()->merge(['stadiumId' => request()->route('stadiumId')]);

        $validator = Validator::make(request()->all(), [
            'stadiumId' => 'required|exists:stadiums,id',
        ]);

        if($validator->fails()){
            return response()->json(['error' => 'Invalid Stadium ID.']);
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
        request()->merge(['zoneId' => request()->route('zoneId')]);

        $validator = Validator::make(request()->all(), [
            'zoneId' => 'required|exists:zones,id',
        ]);

        if($validator->fails()){
            return response()->json(['error' => 'Invalid Zone ID.']);
        }

        $zone = Zone::findOrFail($zoneId);

        return new ZoneResource($zone);
    }

}
