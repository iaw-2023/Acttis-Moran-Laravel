<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Zone;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zone_locations = [
            "NUS",
            "NS",
            "SUS",
            "SS",
            "WUS",
            "WS",
            "EUS",
            "ES",
            "NWQ",
            "NEQ",
            "SWQ",
            "SEQ",
        ];

        for($i = 0; $i<=11; $i++){
            Zone::factory()->state([
                'stadium_location' => $zone_locations[$i],
            ])->create();
        };
    }
}
