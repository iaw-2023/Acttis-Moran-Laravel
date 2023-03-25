<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Stadium;

class StadiumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { /*
        $contador = 0;
        $stadium_names = [["nombre" => "Wembley Stadium", "ciudad" => "Londres"],
    ["nombre" => "Camp Nou", "ciudad" => "Barcelona"],
    ["nombre" => "Allianz Arena", "ciudad" => "Múnich"],
    ["nombre" => "Old Trafford", "ciudad" => "Manchester"],
    ["nombre" => "San Siro", "ciudad" => "Milán"],
    ["nombre" => "Stade de France", "ciudad" => "Saint-Denis"],
    ["nombre" => "Estadio da Luz", "ciudad" => "Lisboa"],
    ["nombre" => "Estadio do Dragao", "ciudad" => "Oporto"],
    ["nombre" => "Signal Iduna Park", "ciudad" => "Dortmund"],
    ["nombre" => "Estadio Santiago Bernabeu", "ciudad" => "Madrid"],
    ["nombre" => "Stadio Olimpico", "ciudad" => "Roma"],
    ["nombre" => "Emirates Stadium", "ciudad" => "Londres"],
    ["nombre" => "Estadio Vicente Calderon", "ciudad" => "Madrid"],
    ["nombre" => "Estadio Benito Villamarin", "ciudad" => "Sevilla"],
    ["nombre" => "Anfield", "ciudad" => "Liverpool"],
    ["nombre" => "Stamford Bridge", "ciudad" => "Londres"],
    ["nombre" => "Parc des Princes", "ciudad" => "París"],
    ["nombre" => "Juventus Stadium", "ciudad" => "Turín"], ];

        Stadium::factory(15)->state(function (array $attributes) use (&$contador, $stadium_names) {
            $stadium = $stadium_names[$contador];
            $contador++;

            return [
                'name' => $stadium["nombre"],
                'located_on_city' => $stadium["ciudad"]
            ];
        })->create();
        */
    }
    
}
