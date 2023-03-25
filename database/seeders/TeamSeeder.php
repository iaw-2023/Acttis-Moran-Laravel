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
        $teams_stadiums_data =  [
            ["stadium_name" => "Wembley Stadium", "city" => "Londres", "team_name" => "Tottenham Hotspur F.C."],
            ["stadium_name" => "Camp Nou", "city" => "Barcelona", "team_name" => "F.C. Barcelona"],
            ["stadium_name" => "Allianz Arena", "city" => "Múnich", "team_name" => "Bayern Múnich"],
            ["stadium_name" => "Old Trafford", "city" => "Manchester", "team_name" => "Manchester United F.C."],
            ["stadium_name" => "San Siro", "city" => "Milán", "team_name" => "A.C. Milan e Inter de Milán"],
            ["stadium_name" => "Stade de France", "city" => "Saint-Denis", "team_name" => "Selección de Francia"],
            ["stadium_name" => "Estadio da Luz", "city" => "Lisboa", "team_name" => "S.L. Benfica"],
            ["stadium_name" => "Estadio do Dragao", "city" => "Oporto", "team_name" => "F.C. Porto"],
            ["stadium_name" => "Signal Iduna Park", "city" => "Dortmund", "team_name" => "Borussia Dortmund"],
            ["stadium_name" => "Estadio Santiago Bernabeu", "city" => "Madrid", "team_name" => "Real Madrid C.F."],
            ["stadium_name" => "Stadio Olimpico", "city" => "Roma", "team_name" => "A.S. Roma e S.S. Lazio"],
            ["stadium_name" => "Emirates Stadium", "city" => "Londres", "team_name" => "Arsenal F.C."],
            ["stadium_name" => "Estadio Vicente Calderon", "city" => "Madrid", "team_name" => "Atlético de Madrid"],
            ["stadium_name" => "Estadio Benito Villamarin", "city" => "Sevilla", "team_name" => "Real Betis Balompié"],
            ["stadium_name" => "Anfield", "city" => "Liverpool", "team_name" => "Liverpool F.C."],
            ["stadium_name" => "Stamford Bridge", "city" => "Londres", "team_name" => "Chelsea F.C."],
            ["stadium_name" => "Parc des Princes", "city" => "París", "team_name" => "Paris Saint-Germain F.C."],
            ["stadium_name" => "Juventus Stadium", "city" => "Turín", "team_name" => "Juventus F.C."]
    ];

        for ($i = 0; $i < count($teams_stadiums_data); $i++) {
            $stadium_data = $teams_stadiums_data[$i];
            $team_name = $stadium_data['team_name'] ?? '';
            $stadium_name = $stadium_data['stadium_name'] ?? '';
            $city = $stadium_data['city'] ?? '';

            $stadium = Stadium::factory()->state([
                'name' => $stadium_name,
                'located_on_city' => $city
            ])->create();

            $team = Team::factory()->state([
                'team_name' => $team_name
            ])->make();

            $stadium->team()->save($team);
        }
    }
}
