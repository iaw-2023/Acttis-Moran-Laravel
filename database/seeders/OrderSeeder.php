<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\Order;
use App\Models\TicketDetail;
use App\Models\User;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tickets = Ticket::all();
        $orders = collect([]);

        //Make Orders
        for($i = 1; $i<=5 ; $i++){
            $orders->push(Order::factory()->create());
        }

        //Make TicketDetails and associate with the orders created
        foreach($orders as $order){
            $user = User::factory()->create();
            $user->orders()->save($order);
            for($i = 0 ; $i < 5; $i++){
                $ticket_detail = TicketDetail::factory()->make();
                $ticket = $tickets->random();
                $ticket->ticketDetails()->save($ticket_detail);
                $order->ticketDetails()->save($ticket_detail);
            }
        }
    }
}
