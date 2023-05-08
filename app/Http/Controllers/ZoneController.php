<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zone;
use App\Models\Ticket;
use App\Http\Resources\ZoneResource;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidateException;

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

        try{
            $this->validateStadiumID(request()->all());
        }
        catch (ValidateException $e) {
            return response()->json(["error" => $e->getMessage()], $e->getStatusCode());
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

        try{
            $this->validateZoneID(request()->all());
        }
        catch (ValidateException $e) {
            return response()->json(["error" => $e->getMessage()], $e->getStatusCode());
        }

        $zone = Zone::findOrFail($zoneId);

        return new ZoneResource($zone);
    }

}
