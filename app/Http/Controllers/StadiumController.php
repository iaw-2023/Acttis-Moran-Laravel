<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stadium;
use App\Http\Resources\StadiumResource;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidateException;

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

        try{
            $this->validateStadiumID(request()->all());
        }
        catch (ValidateException $e) {
            return response()->json(["error" => $e->getMessage()], $e->getStatusCode());
        }

        $stadium = Stadium::findOrFail($stadiumId);

        return new StadiumResource($stadium);
    }

}
