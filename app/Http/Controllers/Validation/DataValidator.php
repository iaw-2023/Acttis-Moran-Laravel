<?php

namespace App\Http\Controllers\Validation;

use Illuminate\Support\Facades\Validator;

class DataValidator
{

    public static function validate($data, $rules){

        $validator = Validator::make($data, $rules, [
            'teamId.min', 'teamId.integer' => "The team ID is invalid.",
            'teamId.exists' => "Not found team with the ID specified.",
            'stadiumId.min', 'stadiumId.integer' => "The stadium ID is invalid.",
            'stadiumId.exists' => "Not found stadium with the ID specified.",
            'date.date' => "The date is invalid.",
            'ticketId.min', 'ticketId.integer' => "The ticket ID is invalid.",
            'ticketId.exists' => "Not found ticket with the ID specified.",
            'zoneId.min', 'zoneId.integer' => "The zone ID is invalid.",
            'zoneId.exists' => "Not found zone with the ID specified.",
            'matchgameId.min', 'matchgameId.integer' => "The matchgame ID is invalid.",
            'matchgameId.exists' => "Not found matchgame with the ID specified.",
            'time.date_format' => "The time is invalid.",
        ]);

        return $validator;
    }

    public static function validateTeamID($data){
        $validator = Validator::make($data, [
            'teamId' => 'required|integer|min:1',
        ], [
            'teamId.min', 'teamId.integer' => "The team ID is invalid.",
        ]);

        return $validator;
    }

    public static function validateStadiumID($data){
        $validator = Validator::make($data, [
            'stadiumId' => 'required|integer|min:1',
        ], [
            'stadiumId.min' => "The stadium ID is invalid.",
        ]);

       return $validator;
    }

    public static function validateDate($data){
        $validator = Validator::make($data, [
            'date' => 'date',
        ], [
            'date.date' => "The date is invalid."
        ]);

        return $validator;
    }

    public static function validateTime($data){
        $validator = Validator::make($data, [
            'time' => 'date_format:H:i',
        ], [
            'time.date_format' => "The time is invalid."
        ]);

        return $validator;
    }

    public static function validateTicketID($data){
        $validator = Validator::make($data, [
            'ticketId' => 'required|integer|min:1',
        ], [
            'ticketId.min', 'ticketId.integer' => "The ticket ID is invalid.",
        ]);

        return $validator;
    }

    public static function validateZoneID($data){
        $validator = Validator::make($data, [
            'zoneId' => 'required|integer|min:1',
        ], [
            'zoneId.min' => "The zone ID is invalid.",
        ]);

        return $validator;
    }

    public static function validateMatchgameID($data){
        $validator = Validator::make($data, [
            'matchgameId' => 'required|integer|min:1',
        ], [
            'matchgameId.min' => "The matchgame ID is invalid.",
        ]);

        return $validator;
    }

    public static function validateCheckoutBody($data){
        $validator = DataValidator::validate($data, [
            "tickets_purchased" => "required",
            'tickets_purchased.*.quantity' => "required|integer|min:1",
            'tickets_purchased.*.ticketId' => "required|exists:tickets,id,deleted_at,NULL",
        ], [
            'tickets_purchased.*.ticketId.exists' => "Invalid Ticket.",
            'tickets_purchased.*.quantity.min' => "Quantity must be greater than 0.",
        ]);

        return $validator;
    }

    public static function validateCartTicketsBody($data){
        $validator = DataValidator::validate($data, [
            "cart_tickets" => "required",
            'cart_tickets.*.ticketId' => "required|exists:tickets,id,deleted_at,NULL",
        ], [
            'cart_tickets.*.ticketId.exists' => "Invalid Ticket.",
        ]);

        return $validator;
    }
}