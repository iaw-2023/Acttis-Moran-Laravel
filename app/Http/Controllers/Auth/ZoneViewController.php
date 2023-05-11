<?php

namespace App\Http\Controllers\Auth;

use App\Http\Resources\ZoneResource;
use App\Models\Zone;
use App\Models\Stadium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ZoneViewController extends HomeController
{
    public function index()
    {
        $zones = Zone::orderBy('id')->paginate(50);
        $stadiums = Stadium::with('zones')->get();
        return view('zones', ['zones' => $zones, 'stadiums' => $stadiums]);
    }

    public function showEditPage($zoneId)
    {
        $zone = Zone::find($zoneId);

        return view('zonesEdit',
                [
                    'zone' => $zone,
                ]
        );
    }


    public function update(Request $request, $zoneId) {

        request()->merge(['zoneId' => request()->route('zoneId')]);

        try{
            $this->validate(request()->all(), [
                'zoneId' => 'required|integer|min:1|exists:zones,id',
                'priceAddition' => 'required|integer|min:0'
            ]);
        }
        catch (ValidateException $e) {
            return redirect()->back()->withErrors([$e->getMessage()])->withInput();
        }

        $zone = Zone::find($zoneId);
        $zone->price_addition = $request->priceAddition;
        $zone->save();

        return redirect("/zones/index")->with('success', 'Zone updated successfully.');
    }

    public function getStadiumZones(Request $request) {

        try{
            $this->validateStadiumID(request()->all());
        }
        catch (ValidateException $e) {
            return redirect()->back()->withErrors([$e->getMessage()])->withInput();
        }

        $zones = Zone::orderBy('id')->where('stadium_id', $request->stadiumId)->paginate(50);
        $stadiums = Stadium::with('zones')->get();
        return view('zones', ['zones' => $zones, 'stadiums' => $stadiums]);
    }
}
