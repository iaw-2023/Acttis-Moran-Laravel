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
            ["zone_code" => "NUS", "stadium_location" => "North Upper Stand"],
            ["zone_code" => "NS", "stadium_location" => "North Stand"],
            ["zone_code" => "SUS", "stadium_location" => "South Upper Stand"],
            ["zone_code" => "SS", "stadium_location" => "South Stand"],
            ["zone_code" => "WUS", "stadium_location" => "West Upper Stand"],
            ["zone_code" => "WS", "stadium_location" => "West Stand"],
            ["zone_code" => "EUS", "stadium_location" => "East Upper Stand"],
            ["zone_code" => "NUS", "stadium_location" => "East Stand"],
            ["zone_code" => "NWQ", "stadium_location" => "North West Quarter"],
            ["zone_code" => "NEQ", "stadium_location" => "North East Quarter"],
            ["zone_code" => "SWQ", "stadium_location" => "South West Quarter"],
            ["zone_code" => "SEQ", "stadium_location" => "South East Quarter"],
        ];

        for($i = 0; $i<=11; $i++){
            Zone::factory()->state([
                'stadium_location' => $zone_locations[$i],
            ])->create();
        };
    }
}
