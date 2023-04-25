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

class OrderController extends Controller
{

    /**
     * Store a newly created Order in storage.
     */
    public function checkOutOrder(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'client_data.client_email' => "required|email",
            'tickets_purchased.*.ticket_id' => "required|exists:tickets,id",
            'tickets_purchased.*.quantity' => "required|integer|min:1",
        ]);

        if($validator->fails()){
            return response()->json(['error' => 'Invalid request body. Client data or tickets purchased info are not valid.']);
        }
        
        $clientData = $request->client_data;
        $ticketsPurchased = $request->tickets_purchased;
        $ticketDetails = collect();
        
        foreach($ticketsPurchased as $ticket){
            $ticketDetail = TicketDetail::create(['ticket_quantity' => $ticket['quantity']]);
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
