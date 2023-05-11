<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidateException;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function validate($data, $rules){
        $validator = Validator::make($data, $rules, [
            'teamId.min' => "The team ID is invalid.",
            'teamId.exists' => "Not found a team with the ID specified.",
            'stadiumId.min' => "The stadium ID is invalid.",
            'stadiumId.exists' => "Not found a stadium with the ID specified.",
            'date.date' => "The date is invalid.",
            'ticketId.min' => "The ticket ID is invalid.",
            'ticketId.exists' => "Not found a ticket with the ID specified.",
            'zoneId.min' => "The zone ID is invalid.",
            'zoneId.exists' => "Not found a zone with the ID specified.",
            'matchgameId.min' => "The matchgame ID is invalid.",
            'matchgameId.exists' => "Not found a matchgame with the ID specified.",
            'time.time' => "The time is invalid.",
        ]);

        if($validator->fails()){
            $validateException = new ValidateException(400, $validator->errors()->first());
            throw $validateException;
        }
    }

    protected function validateTeamID($data){
        $validator = Validator::make($data, [
            'teamId' => 'required|integer|min:1|exists:teams,id',
        ], [
            'teamId.min' => "The team ID is invalid.",
            'teamId.exists' => "Not found a team with the ID specified.",
        ]);

        if($validator->fails()){
            $statusCode = 400;
            if((isset($validator->failed()["teamId"]["Exists"]))){
                $statusCode = 404;
            }
            $validateException = new ValidateException($statusCode, $validator->errors()->first());
            throw $validateException;
        }
    }

    protected function validateStadiumID($data){
        $validator = Validator::make($data, [
            'stadiumId' => 'required|integer|min:1|exists:stadiums,id',
        ], [
            'stadiumId.min' => "The stadium ID is invalid.",
            'stadiumId.exists' => "Not found a stadium with the ID specified.",
        ]);

        if($validator->fails()){
            $statusCode = 400;
            if((isset($validator->failed()["stadiumId"]["Exists"]))){
                $statusCode = 404;
            }
            $validateException = new ValidateException($statusCode, $validator->errors()->first());
            throw $validateException;
        }
    }

    protected function validateDate($data){
        $validator = Validator::make($data, [
            'date' => 'date',
        ], [
            'date.date' => "The date is invalid."
        ]);

        if($validator->fails()){
            $validateException = new ValidateException(400, $validator->errors()->first());
            throw $validateException;
        }
    }

    protected function validateTime($data){
        $validator = Validator::make($data, [
            'time' => 'date_format:H:i',
        ], [
            'time.date_format' => "The time is invalid."
        ]);

        if($validator->fails()){
            $validateException = new ValidateException(400, $validator->errors()->first());
            throw $validateException;
        }
    }

    protected function validateTicketID($data){
        $validator = Validator::make($data, [
            'ticketId' => 'required|integer|min:1|exists:tickets,id',
        ], [
            'ticketId.min' => "The ticket ID is invalid.",
            'ticketId.exists' => "Not found a ticket with the ID specified.",
        ]);

        if($validator->fails()){
            $statusCode = 400;
            if((isset($validator->failed()["ticketId"]["Exists"]))){
                $statusCode = 404;
            }
            $validateException = new ValidateException($statusCode, $validator->errors()->first());
            throw $validateException;
        }
    }

    protected function validateZoneID($data){
        $validator = Validator::make($data, [
            'zoneId' => 'required|integer|min:1|exists:zones,id',
        ], [
            'zoneId.min' => "The zone ID is invalid.",
            'zoneId.exists' => "Not found a zone with the ID specified.",
        ]);

        if($validator->fails()){
            $statusCode = 400;
            if((isset($validator->failed()["zoneId"]["Exists"]))){
                $statusCode = 404;
            }
            $validateException = new ValidateException($statusCode, $validator->errors()->first());
            throw $validateException;
        }
    }

    protected function validateMatchgameID($data){
        $validator = Validator::make($data, [
            'matchgameId' => 'required|integer|min:1|exists:matchgames,id',
        ], [
            'matchgameId.min' => "The matchgame ID is invalid.",
            'matchgameId.exists' => "Not found a matchgame with the ID specified.",
        ]);

        if($validator->fails()){
            $statusCode = 400;
            if((isset($validator->failed()["matchgameId"]["Exists"]))){
                $statusCode = 404;
            }
            $validateException = new ValidateException($statusCode, $validator->errors()->first());
            throw $validateException;
        }
    }

    
}
