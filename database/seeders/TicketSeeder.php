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
                $ticket = Ticket::factory()->make();
                $zone->tickets()->save($ticket);
                $match->tickets()->save($ticket);
            }
        }
    }
}
