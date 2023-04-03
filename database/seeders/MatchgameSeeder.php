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

        $local_team = null;
        $away_team = null;
        $played_on_stadium = null;

        foreach($teams as $key => $team) {
            if($key % 2 == 0){
                $local_team = $team;
                $played_on_stadium = Stadium::find($team->local_stadium_id);
            }
            else {
                $away_team = $team;

                $matchgame = Matchgame::factory()->make();
                $teams_playing_match = TeamsPlayingMatch::factory()->make();

                $local_team->teamsPlayingMatchHome()->save($teams_playing_match);
                $away_team->teamsPlayingMatchAway()->save($teams_playing_match);

                $teams_playing_match->matchgame()->save($matchgame);
                $played_on_stadium->matchgames()->save($matchgame);
            }
        }
    }
}
