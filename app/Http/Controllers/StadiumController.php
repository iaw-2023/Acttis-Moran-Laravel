<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stadium;
use App\Http\Resources\StadiumResource;
use Illuminate\Support\Facades\Validator;

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
        request()->merge(['stadiumId' => request()->route('stadiumId')]);

        $validator = Validator::make(request()->all(), [
            'stadiumId' => 'required|integer|min:1',
        ]);

        if($validator->fails()){
            return response()->json(['error' => 'Invalid Stadium ID.'], 400);
        }

        $stadium = Stadium::find($stadiumId);

        if($stadium == null)
            return response()->json(['error' => 'Stadium not found.'], 404);

        return new StadiumResource($stadium);
    }

}
