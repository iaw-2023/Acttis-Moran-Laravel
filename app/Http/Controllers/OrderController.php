<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketDetail;
use App\Models\Ticket;
use App\Models\TicketOrder;
use App\Models\Order;
use App\Models\Zone;
Use \Carbon\Carbon;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidateException;

class OrderController extends Controller
{
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
     * Store a newly created Order in storage.
     */
    public function checkOutOrder(Request $request)
    {  
        try{
            $this->validateCheckoutBody($request->all());
        }
        catch(ValidateException $e){
            return response()->json(["error" => $e->getMessage()], $e->getStatusCode());
        }
        
        $clientData = $request->client_data;
        $ticketsPurchased = $request->tickets_purchased;
        $ticketDetails = collect();
        
        foreach($ticketsPurchased as $ticket){
            $ticketDetail = TicketDetail::make(['ticket_quantity' => $ticket['quantity']]);

            $actualTicket = Ticket::find($ticket['ticket_id']);
            $actualTicket->ticketDetails()->save($ticketDetail);
            
            $ticketDetails->push($ticketDetail);
        }
        
        $totalPrice = $this->getTotalPrice($ticketDetails);
        $dateTime = Carbon::now();
        $order = Order::create(['total_price' => $totalPrice, 'client_email' => $clientData['client_email'], 'checkout_date'=> $dateTime]);
        foreach ($ticketDetails as $ticketDetail) {
            $order->ticketDetails()->save($ticketDetail);
        }
        
        return response()->json([
            'success' => "Generated Order successfully!",
            'order_created' => new OrderResource($order),
        ]);
        
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
