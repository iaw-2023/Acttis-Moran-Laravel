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
        
        $zones = Zone::factory()->count(4)->create();

        foreach($matchgames as $match){
            $tickets = Ticket::factory()->count(10)->make();
            foreach ($tickets as $ticket) {
                $zone = $zones->random();
                $zone->tickets()->save($ticket);
                $match->tickets()->save($ticket);
            }
        }
    }
}
