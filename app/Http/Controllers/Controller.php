<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     title="You Ticket API",
 *     version="1.0.11"
 * )
 *
 * @OA\Server(
 *     url="https://acttis-moran-laravel-pdib.vercel.app/restapi"
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
}
