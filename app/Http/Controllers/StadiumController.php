<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stadium;
use App\Http\Resources\StadiumResource;
use App\Http\Controllers\Validation\DataValidator;

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

        $validator = DataValidator::validateStadiumID(request()->all());

        if($validator->fails()){
            return response()->json(["error" => $validator->errors()->first()], 400);
        }

        $stadium = Stadium::find($stadiumId);

        if(!$stadium)
            return response()->json(["error" => "Not found Stadium."], 404);

        return new StadiumResource($stadium);
    }

}
