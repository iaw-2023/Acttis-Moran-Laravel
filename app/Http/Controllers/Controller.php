<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidateException;

/**
 * @OA\Info(
 *     title="You Ticket API",
 *     version="1.0.11"
 * )
 *
 * @OA\Server(
 *     url="http://vercel.com/acttis-moran/acttis-moran-laravel/restapi"
 * )
 *
 * @OA\Tag(
 *     name="matchgame",
 *     description="Este endpoint maneja toda la informacion relacionada a los matchgame's. En este end-point se devolveran recursos Matchgame."
 * )
 *
 * @OA\Tag(
 *     name="team",
 *     description="Este endpoint maneja toda la informacion relacionada a los team's. En este end-point se devolveran recursos Team."
 * )
 *
 * @OA\Tag(
 *     name="stadium",
 *     description="Este endpoint maneja toda la informacion relacionada a los stadium's. En este end-point se devolveran recursos Stadium."
 * )
 *
 * @OA\Tag(
 *     name="ticket",
 *     description="Este endpoint maneja toda la informacion relacionada a los ticket's. En este end-point se devolveran recursos Ticket."
 * )
 *
 * @OA\Tag(
 *     name="zone",
 *     description="Este endpoint maneja toda la informacion relacionada a las zone's. En este end-point se devolveran recursos Zone."
 * )
 *
 * @OA\Tag(
 *     name="order",
 *     description="Este endpoint maneja toda la informacion relacionada a las order's. En este end-point se realiza la creacion de Order's."
 * )
 *
 *
 * @OA\Schema(
 *   schema="BodyOrderCheckout",
 *   type="object",
 *   @OA\Property(property="client_data", type="object", 
 *       @OA\Property(property="client_email", type="string", description="Client's Email.")
 *   ),
 *   @OA\Property(property="tickets_purchased", type="array", 
 *       @OA\Items(ref="#/components/schemas/TicketOrder"),
 *   )
 * )
 * 
 * @OA\Schema(
 *     schema="TicketOrder",
 *     type="object",
 *     @OA\Property(property="ticketId", type="integer", description="Ticket to buy ID."),
 *     @OA\Property(property="quantity", type="integer", description="Quantity of ticket's to buy.")
 * )
 * 
 * @OA\Schema(
 *   schema="SuccessfulOrderPost",
 *   type="object",
 *   @OA\Property(property="success", type="string", description="Success Message."),
 *   @OA\Property(property="order_created", type="object", 
 *      @OA\Property(property="total_price", type="integer", description="Purchase total price."),
 *      @OA\Property(property="checkout_date", type="string", description="Date"),
 *      @OA\Property(property="client_email", type="string", description="Client's email."),
 *   )
 * )
*/

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

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
