<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zone;
use App\Models\Ticket;
use App\Http\Resources\ZoneResource;
use App\Http\Controllers\Validation\DataValidator;

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

        $validator = DataValidator::validateStadiumID(request()->all());

        if($validator->fails()){
            return response()->json(["error" => $validator->errors()->first()], 400);
        }

        $zones = Zone::where('stadium_id', $stadiumId)->get();

        if($zones->isEmpty())
            return response()->json(["error" => "Zones not found."], 404);

        return ZoneResource::collection($zones);   
    }

    /**
     * Display the specified resource.
     * @param int $zoneId
     */
    public function show($zoneId)
    {
        request()->merge(['zoneId' => request()->route('zoneId')]);

        $validator = DataValidator::validateZoneID(request()->all());

        if($validator->fails()){
            return response()->json(["error" => $validator->errors()->first()], 400);
        }

        $zone = Zone::find($zoneId);

        if(!$zone)
            return response()->json(["error" => "Zone not found."], 404);

        return new ZoneResource($zone);
    }

}
