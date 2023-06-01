<?php

namespace App\Http\Controllers;

use App\Mail\CheckoutConfirmationEmail;
use Illuminate\Http\Request;
use App\Models\TicketDetail;
use App\Models\Ticket;
use App\Models\TicketOrder;
use App\Models\Order;
use App\Models\Zone;
Use \Carbon\Carbon;
use App\Http\Resources\OrderResource;
use App\Http\Controllers\Validation\DataValidator;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{

    /**
     * Store a newly created Order in storage.
     *
     *
     * @OA\Post(
     *     path="/order/checkout",
     *     tags={"order"},
     *     summary="Inserta informacion de nueva order en la base de datos",
     *     requestBody={
     *        "required": true,
     *        "content": {
     *            "application/json": {
     *                "schema": {
     *                    "$ref": "#/components/schemas/BodyOrderCheckout"
     *                }
     *            }
     *        }
     *     },
     *     @OA\Response(
     *         response="200",
     *         description="(OK) La informacion de la order se guardo correctamente",
     *         @OA\JsonContent(
     *           type="object",
     *           @OA\Property(ref="#/components/schemas/SuccessfulOrderPost")
     *         )
     *     ),
     *     @OA\Response(response="400", description="(Bad Request) Los datos enviados son incorrectos o hay datos obligatorios no enviados"),
     *     @OA\Response(response="404", description="(NotFound) No se encontro informacion"),
     *     @OA\Response(response="500", description="Error en servidor")
     * )
    */

    public function checkOutOrder(Request $request)
    {

        $validator = DataValidator::validateCheckoutBody($request->all());

        if($validator->fails()){
            return response()->json(["error" => $validator->errors()->first()], 400);
        }

        $clientData = $request->client_data;
        $ticketsPurchased = $request->tickets_purchased;
        $ticketDetails = collect();

        foreach($ticketsPurchased as $ticket){
            $ticketDetail = TicketDetail::make(['ticket_quantity' => $ticket['quantity']]);

            $actualTicket = Ticket::find($ticket['ticketId']);
            $actualTicket->ticketDetails()->save($ticketDetail);

            $ticketDetails->push($ticketDetail);
        }

        $totalPrice = $this->getTotalPrice($ticketDetails);
        $dateTime = Carbon::now();
        $order = Order::create(['total_price' => $totalPrice, 'client_email' => $clientData['client_email'], 'checkout_date'=> $dateTime]);
        foreach ($ticketDetails as $ticketDetail) {
            $order->ticketDetails()->save($ticketDetail);
        }

        Mail::to($clientData['client_email'])->send(new CheckoutConfirmationEmail($order, $ticketDetails, $totalPrice));

        return response()->json([
            'success' => "Generated Order successfully!",
            'order_created' => new OrderResource($order),
        ]);


    }

    /**
     * Validates client email the quantity of each ticket and all ticket id's
     */
    protected function validateCheckoutBody($data){

        $validator = Validator::make($data, [
            "tickets_purchased" => "required",
            "client_data" => "required",
            'client_data.client_email' => "required|email",
            'tickets_purchased.*.quantity' => "required|integer|min:1",
            'tickets_purchased.*.ticketId' => "required",
        ], [
            'tickets_purchased.*.quantity.min' => "Quantity must be greater than 0.",
            'client_data.client_email.email' => "Invalid client email.",
        ]);

        if($validator->fails()){
            $validateException = new ValidateException(400, $validator->errors()->first());
            throw $validateException;
        }

        $ticketsPurchased = $data["tickets_purchased"];

        foreach($ticketsPurchased as $ticket) {
            $this->validateTicketID($ticket);
        };

    }

    /**
     * Auxiliar function to verify the correct
     * total price amount.
     */
    protected function getTotalPrice($ticketDetails){
        $acummulatedCost = 0;
        foreach($ticketDetails as $ticketDetail){
            $ticket = $ticketDetail->ticket;
            $ticketZone = $ticket->zone;
            $acummulatedCost += ($ticket->base_price + $ticketZone->price_addition) * $ticketDetail->ticket_quantity;
        }

        return $acummulatedCost;
    }

}
