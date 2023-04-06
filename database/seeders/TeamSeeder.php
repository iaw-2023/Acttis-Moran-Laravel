<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\Stadium;

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
                ["stadium_name" => "Stade de France", "city" => "Saint-Denis", "team_name" => "Selección de Francia", "capacity" => 81000],
                ["stadium_name" => "Estadio da Luz", "city" => "Lisboa", "team_name" => "S.L. Benfica", "capacity" => 65000],
                ["stadium_name" => "Estadio do Dragao", "city" => "Oporto", "team_name" => "F.C. Porto", "capacity" => 50000],
                ["stadium_name" => "Signal Iduna Park", "city" => "Dortmund", "team_name" => "Borussia Dortmund", "capacity" => 81000],
                ["stadium_name" => "Estadio Santiago Bernabeu", "city" => "Madrid", "team_name" => "Real Madrid C.F.", "capacity" => 81000],
                ["stadium_name" => "Stadio Olimpico", "city" => "Roma", "team_name" => "A.S. Roma", "capacity" => 72000],
                ["stadium_name" => "Emirates Stadium", "city" => "Londres", "team_name" => "Arsenal F.C.", "capacity" => 60000],
                ["stadium_name" => "Estadio Vicente Calderon", "city" => "Madrid", "team_name" => "Atlético de Madrid", "capacity" => 55000],
                ["stadium_name" => "Estadio Benito Villamarin", "city" => "Sevilla", "team_name" => "Real Betis Balompié", "capacity" => 60000],
                ["stadium_name" => "Anfield", "city" => "Liverpool", "team_name" => "Liverpool F.C.", "capacity" => 54000],
                ["stadium_name" => "Stamford Bridge", "city" => "Londres", "team_name" => "Chelsea F.C.", "capacity" => 42000],
                ["stadium_name" => "Parc des Princes", "city" => "París", "team_name" => "Paris Saint-Germain F.C.", "capacity" => 48000],
                ["stadium_name" => "Juventus Stadium", "city" => "Turín", "team_name" => "Juventus F.C.", "capacity" => 41000],
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

            $team = Team::factory()->state([
                'team_name' => $team_name
            ])->make();

            $stadium->team()->save($team);
        }
    }
}
