<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Matchgame;
use App\Models\TeamsPlayingMatch;
use App\Models\Stadium;
use App\Models\Team;

class MatchgameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = Team::all();
        
        $count = 0;
        $local_team = null;
        $away_team = null;
        $played_on_stadium = null;

        foreach($teams as $team) {
            $count++;
            if($count == 1){
                $local_team = $team;
                $played_on_stadium = Stadium::where('id', $team->local_stadium_id)->first();
            }
            else {
                $count = 0;
                $away_team = $team;

                $matchgame = Matchgame::factory()->make();
                $teams_playing_match = TeamsPlayingMatch::factory()->make();
                
                //$teams_playing_match->teams()->attach($local_team);
                //$teams_playing_match->teams()->attach($away_team);

                $local_team->teamsPlayingMatchHome()->save($teams_playing_match);
                $away_team->teamsPlayingMatchAway()->save($teams_playing_match);

                $teams_playing_match->matchgame()->save($matchgame);
                $played_on_stadium->matchgames()->save($matchgame);
            }
        }
    }
}
