<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Matchgame;
use App\Models\TeamPlayingMatch;
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

                $matchgame = Matchgame::factory()->create();
                $team_playing_match_home_team = TeamPlayingMatch::factory()->state(['condition' => 'home'])->make();
                $team_playing_match_away_team = TeamPlayingMatch::factory()->state(['condition' => 'away'])->make();

                $local_team->teamPlayingMatchs()->save($team_playing_match_home_team);
                $away_team->teamPlayingMatchs()->save($team_playing_match_away_team);

                $matchgame->teamsPlayingMatch()->save($team_playing_match_home_team);
                $matchgame->teamsPlayingMatch()->save($team_playing_match_away_team);
                $played_on_stadium->matchgames()->save($matchgame);
            }
        }
    }
}
