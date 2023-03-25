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
        $index = 0;
        $teams_stadiums_data =  [    ["nombre" => "Wembley Stadium", "ciudad" => "Londres", "team_name" => "Tottenham Hotspur F.C."],
        ["nombre" => "Camp Nou", "ciudad" => "Barcelona", "team_name" => "F.C. Barcelona"],
        ["nombre" => "Allianz Arena", "ciudad" => "Múnich", "team_name" => "Bayern Múnich"],
        ["nombre" => "Old Trafford", "ciudad" => "Manchester", "team_name" => "Manchester United F.C."],
        ["nombre" => "San Siro", "ciudad" => "Milán", "team_name" => "A.C. Milan e Inter de Milán"],
        ["nombre" => "Stade de France", "ciudad" => "Saint-Denis", "team_name" => "Selección de Francia"],
        ["nombre" => "Estadio da Luz", "ciudad" => "Lisboa", "team_name" => "S.L. Benfica"],
        ["nombre" => "Estadio do Dragao", "ciudad" => "Oporto", "team_name" => "F.C. Porto"],
        ["nombre" => "Signal Iduna Park", "ciudad" => "Dortmund", "team_name" => "Borussia Dortmund"],
        ["nombre" => "Estadio Santiago Bernabeu", "ciudad" => "Madrid", "team_name" => "Real Madrid C.F."],
        ["nombre" => "Stadio Olimpico", "ciudad" => "Roma", "team_name" => "A.S. Roma e S.S. Lazio"],
        ["nombre" => "Emirates Stadium", "ciudad" => "Londres", "team_name" => "Arsenal F.C."],
        ["nombre" => "Estadio Vicente Calderon", "ciudad" => "Madrid", "team_name" => "Atlético de Madrid"],
        ["nombre" => "Estadio Benito Villamarin", "ciudad" => "Sevilla", "team_name" => "Real Betis Balompié"],
        ["nombre" => "Anfield", "ciudad" => "Liverpool", "team_name" => "Liverpool F.C."],
        ["nombre" => "Stamford Bridge", "ciudad" => "Londres", "team_name" => "Chelsea F.C."],
        ["nombre" => "Parc des Princes", "ciudad" => "París", "team_name" => "Paris Saint-Germain F.C."],
        ["nombre" => "Juventus Stadium", "ciudad" => "Turín", "team_name" => "Juventus F.C."]
    ]; 

        $stadiums = Stadium::factory(15)->state((function (array $attributes) use (&$index, $teams_stadiums_data) {
            $stadium_selection = $teams_stadiums_data[$index];
            $index++;
            return [
                'name' => $stadium_selection["nombre"],
                'located_on_city' => $stadium_selection["ciudad"]
            ];
        }))->create();
        $index = 0;
        foreach ($stadiums as $stadium) {
            $team = Team::factory()->state((function (array $attributes) use (&$index, $teams_stadiums_data) {
                $team_selection = $teams_stadiums_data[$index];
                $index++;
                return [
                    'team_name' => $team_selection["team_name"],
                ];
            }))->make();
            $stadium->team()->save($team);
        }
    }
}
