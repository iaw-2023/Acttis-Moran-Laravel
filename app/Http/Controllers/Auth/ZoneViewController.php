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
        $zones = Zone::orderBy('id')->paginate(20);
        return view('zones', compact('zones'));
    }

    public function editPage($zoneId)
    {
        $zone = Zone::find($zoneId);

        return view('zonesEdit',
                [
                    'zone' => $zone,
                ]
        );
    }


    public function update(Request $request, $zoneId) {

        return redirect("/zones/index")->with('success', 'Zone updated successfully.');
    }

    
}
