<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\Stadium;
use App\Models\Zone;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams_stadiums_data = 
            [   ["stadium_name" => "Wembley Stadium", "city" => "Londres", "team_name" => "Tottenham Hotspur F.C.", "capacity" => 90000],
                ["stadium_name" => "Camp Nou", "city" => "Barcelona", "team_name" => "F.C. Barcelona", "capacity" => 99000],
                ["stadium_name" => "Allianz Arena", "city" => "Múnich", "team_name" => "Bayern Múnich", "capacity" => 70000],
                ["stadium_name" => "Old Trafford", "city" => "Manchester", "team_name" => "Manchester United F.C.", "capacity" => 74000],
                ["stadium_name" => "San Siro", "city" => "Milán", "team_name" => "A.C. Milan", "capacity" => 80000],
                ["stadium_name" => "Estadio da Luz", "city" => "Lisboa", "team_name" => "S.L. Benfica", "capacity" => 65000],
                ["stadium_name" => "Estadio do Dragao", "city" => "Oporto", "team_name" => "F.C. Porto", "capacity" => 50000],
                ["stadium_name" => "Signal Iduna Park", "city" => "Dortmund", "team_name" => "Borussia Dortmund", "capacity" => 81000],
                ["stadium_name" => "Estadio Santiago Bernabeu", "city" => "Madrid", "team_name" => "Real Madrid C.F.", "capacity" => 81000],
                ["stadium_name" => "Stadio Olimpico", "city" => "Roma", "team_name" => "A.S. Roma", "capacity" => 72000],
                ["stadium_name" => "Emirates Stadium", "city" => "Londres", "team_name" => "Arsenal F.C.", "capacity" => 60000],
                ["stadium_name" => "Wanda Metropolitano", "city" => "Madrid", "team_name" => "Atlético de Madrid", "capacity" => 55000],
                ["stadium_name" => "Johan Cruijff Arena", "city" => "Amsterdam", "team_name" => "Ajax", "capacity" => 55500],
                ["stadium_name" => "Etihad Stadium", "city" => "Manchester", "team_name" => "Manchester City", "capacity" => 55000],
                ["stadium_name" => "Anfield", "city" => "Liverpool", "team_name" => "Liverpool F.C.", "capacity" => 54000],
                ["stadium_name" => "Stamford Bridge", "city" => "Londres", "team_name" => "Chelsea F.C.", "capacity" => 42000],
                ["stadium_name" => "Parc des Princes", "city" => "París", "team_name" => "Paris Saint-Germain F.C.", "capacity" => 48000],
                ["stadium_name" => "Juventus Stadium", "city" => "Turín", "team_name" => "Juventus F.C.", "capacity" => 41000],
            ];

        $zone_locations = [
            ["zone_code" => "NUS", "stadium_location" => "North Upper Stand"],
            ["zone_code" => "NS", "stadium_location" => "North Stand"],
            ["zone_code" => "SUS", "stadium_location" => "South Upper Stand"],
            ["zone_code" => "SS", "stadium_location" => "South Stand"],
            ["zone_code" => "WUS", "stadium_location" => "West Upper Stand"],
            ["zone_code" => "WS", "stadium_location" => "West Stand"],
            ["zone_code" => "EUS", "stadium_location" => "East Upper Stand"],
            ["zone_code" => "ES", "stadium_location" => "East Stand"],
            ["zone_code" => "NWQ", "stadium_location" => "North West Quarter"],
            ["zone_code" => "NEQ", "stadium_location" => "North East Quarter"],
            ["zone_code" => "SWQ", "stadium_location" => "South West Quarter"],
            ["zone_code" => "SEQ", "stadium_location" => "South East Quarter"],
        ];

        for ($i = 0; $i < count($teams_stadiums_data); $i++) {
            $stadium_data = $teams_stadiums_data[$i];
            $team_name = $stadium_data['team_name'] ?? '';
            $stadium_name = $stadium_data['stadium_name'] ?? '';
            $city = $stadium_data['city'] ?? '';
            $capacity = $stadium_data['capacity'] ?? 0;

            $stadium = Stadium::factory()->state([
                'stadium_name' => $stadium_name,
                'located_on_city' => $city,
                'capacity' => $capacity,
            ])->create();

            foreach($zone_locations as $zone){
                $zone_model = Zone::factory()->state([
                    'stadium_location' => $stadium_name." ".$zone["stadium_location"],
                    'zone_code' => $zone["zone_code"],
                ])->make();

                $stadium->zones()->save($zone_model);
            }

            $team = Team::factory()->state([
                'team_name' => $team_name
            ])->make();

            $stadium->team()->save($team);
        }
    }
}
