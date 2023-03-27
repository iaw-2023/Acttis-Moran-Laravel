<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Matchgame;
use App\Models\Stadium;
use App\Models\Team;

class MatchgameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = DB::table('teams')->get();
        
        $count = 0;
        $local_team = null;
        $away_team = null;
        $played_on_stadium = null;

        foreach($teams as $team) {
            $count++;
            if($count == 1){
                $local_team = Team::hydrate(json_decode(json_encode($team), true));
                $played_on_stadium = Stadium::hydrate(json_decode(json_encode(DB::table('stadiums')->where('id', $team->local_stadium_id)->first(), true)));
            }
            else {
                $count = 0;
                $away_team = Team::hydrate(json_decode(json_encode($team), true));

                $matchgame = Matchgame::factory()->make();
                $matchgame->stadium()->save($played_on_stadium);
                $matchgame->teams()->save($local_team);
                $matchgame->teams()->save($away_team);
                //$played_on_stadium->save($matchgame);
            }
        }
    }
}
