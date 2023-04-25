<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stadium;
use App\Http\Resources\StadiumResource;

class StadiumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stadiums = Stadium::all();

        return StadiumResource::collection($stadiums);
    }


    /**
     * Display the specified resource.
     * @param int $stadiumId
     */
    public function show($stadiumId)
    {
        if(!is_numeric($stadiumId) || $stadiumId < 1){
            return response()->json(['errors' => "The stadium id specified is invalid."]);
        }

        $stadium = Stadium::findOrFail($stadiumId);

        return new StadiumResource($stadium);
    }

}
