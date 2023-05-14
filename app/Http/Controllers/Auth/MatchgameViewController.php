<?php

namespace App\Http\Controllers\Auth;

use App\Http\Resources\ZoneResource;
use App\Models\Matchgame;
use App\Models\Team;
use App\Models\TeamPlayingMatch;
use App\Models\Stadium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class MatchgameViewController extends HomeController
{
    public function index()
    {
        $matchgames = MatchGame::orderBy('id')->paginate(20);
        return view('matchgames',compact('matchgames'));
    }

    public function delete($matchgameId)
    {
        request()->merge(['matchgameId' => request()->route('matchgameId')]);

        try{
            $this->validateMatchgameId(request()->all());
        }
        catch (ValidateException $e) {
            return redirect()->back()->withErrors([$e->getMessage()])->withInput();
        }

        $matchgame = Matchgame::find($matchgameId);
        $matchgame->delete();
        
        return redirect()->back()->with('success', 'Matchgame deleted successfully.');
    }

    public function showEditPage($matchgameId){
        request()->merge(['matchgameId' => request()->route('matchgameId')]);

        try{
            $this->validateMatchgameId(request()->all());
        }
        catch (ValidateException $e) {
            return redirect()->back()->withErrors([$e->getMessage()])->withInput();
        }

        $matchgame = Matchgame::find($matchgameId);
        $teams = Team::all();
        $stadiums = Stadium::all();
        return view('matchgamesEdit',
                [
                    'matchgame' => $matchgame,
                    'teams' => $teams,
                    'stadiums' => $stadiums,
                ]
        );
    }

    public function showCreatePage()
    {
        $teams = Team::all();
        $stadiums = Stadium::all();
        return view('matchgamesCreate',
                [
                    'teams' => $teams,
                    'stadiums' => $stadiums,
                ]
        );
    }

    public function update(Request $request, $matchgameId) {

        request()->merge(['matchgameId' => request()->route('matchgameId')]);

        try{
            $this->validate(request()->all(), [
                'matchgameId' => 'required|integer|min:1|exists:matchgames,id',
                'homeTeamId' => 'required|integer|min:1|exists:teams,id',
                'awayTeamId' => 'required|integer|min:1|exists:teams,id',
                'date' => 'date',
                'time' => 'date_format:H:i',
            ]);
        }
        catch (ValidateException $e) {
            return redirect()->back()->withErrors([$e->getMessage()])->withInput();
        }

        $matchgame = Matchgame::find($matchgameId);
        $homeTeamPlaying = $matchgame->teamsPlayingMatch[0];
        $awayTeamPlaying = $matchgame->teamsPlayingMatch[1];
        
        $matchgame->played_on_date = $request->date;
        $matchgame->played_on_time = $request->time;

        $homeTeamPlaying->team_id = $request->homeTeamId;
        $homeTeamPlaying->condition = "home";
        $awayTeamPlaying->team_id = $request->awayTeamId;
        $awayTeamPlaying->condition = "away";
        
        $homeTeamPlaying->save();
        $awayTeamPlaying->save();
        $matchgame->save();

        return redirect("/matchgames/index")->with('success', 'Matchgame updated successfully.');
    }

    public function store(Request $request) {

        try{
            $this->validate(request()->all(), [
                'homeTeamId' => 'required|integer|min:1|exists:teams,id',
                'awayTeamId' => 'required|integer|min:1|exists:teams,id',
                'date' => 'date|date_format:d-m-Y',
                'time' => 'date_format:H:i',
            ]);
        }
        catch (ValidateException $e) {
            return redirect()->back()->withErrors([$e->getMessage()])->withInput();
        }
        
        $matchgame = Matchgame::factory()->state(['played_on_date' => $request->date, 'played_on_time' => $request->time])->create();

        $matchgame->stadium_id = $request->stadiumId;

        $homeTeamPlaying = new TeamPlayingMatch();
        $homeTeamPlaying->team_id = $request->homeTeamId;
        $homeTeamPlaying->condition = "home";

        $awayTeamPlaying = new TeamPlayingMatch();
        $awayTeamPlaying->team_id = $request->awayTeamId;
        $awayTeamPlaying->condition = "away";

        $homeTeamPlaying->matchgame_id = $matchgame->id;
        $awayTeamPlaying->matchgame_id = $matchgame->id;

        $homeTeamPlaying->save();
        $awayTeamPlaying->save();

        $matchgame->save();
        
        return redirect("/matchgames/index")->with('success', 'Matchgame created successfully.');
    }
}
