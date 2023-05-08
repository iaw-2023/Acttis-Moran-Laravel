<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Matchgame;
use App\Models\Ticket;
use App\Models\Zone;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $matchgames = Matchgame::all();

        foreach($matchgames as $match){
            $zones = Zone::where('stadium_id', $match->stadium_id)->get();
            foreach ($zones as $zone) {
                $ticketEconomic = Ticket::factory()->state(['category' => 'Economic'])->make();
                $ticketBasic = Ticket::factory()->state(['category' => 'Basic'])->make();
                $ticketPremium = Ticket::factory()->state(['category' => 'Premium'])->make();

                $zone->tickets()->save($ticketEconomic);
                $zone->tickets()->save($ticketBasic);
                $zone->tickets()->save($ticketPremium);
                
                $match->tickets()->save($ticketEconomic);
                $match->tickets()->save($ticketBasic);
                $match->tickets()->save($ticketPremium);
            }
        }
    }
}
