<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Validation\DataValidator;
use App\Models\Matchgame;
use App\Models\Stadium;
use App\Models\Team;
use App\Models\TeamPlayingMatch;
use Illuminate\Http\Request;

class MatchgameViewController extends HomeController
{
    public function index()
    {
        $matchgames = MatchGame::orderBy('id')->withTrashed()->paginate(20);
        return view('matchgames',compact('matchgames'));
    }

    public function delete($matchgameId)
    {
        request()->merge(['matchgameId' => request()->route('matchgameId')]);

        $validator = DataValidator::validateMatchgameID(request()->all());

        if($validator->fails()){
            return redirect()->back()->withErrors([$validator->errors()->first()])->withInput();
        }

        $matchgame = Matchgame::find($matchgameId);

        if(!$matchgame)
            return redirect()->back()->withErrors(["Matchgame not found"])->withInput();

        $matchgame->delete();

        return redirect()->back()->with('success', 'Matchgame deleted successfully.');
    }

    public function showEditPage($matchgameId){
        request()->merge(['matchgameId' => request()->route('matchgameId')]);

        $validator = DataValidator::validateMatchgameID(request()->all());

        if($validator->fails()){
            return redirect()->back()->withErrors([$validator->errors()->first()])->withInput();
        }

        $matchgame = Matchgame::find($matchgameId);

        if(!$matchgame)
            return redirect()->back()->withErrors(["Matchgame not found"])->withInput();

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

        $validator = DataValidator::validate(request()->all(), [
            'matchgameId' => 'required|exists:matchgames,id',
            'homeTeamId' => 'required|exists:teams,id',
            'awayTeamId' => 'required|exists:teams,id',
            'date' => 'date',
            'time' => 'date_format:H:i',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors([$validator->errors()->first()])->withInput();
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

        $validator = DataValidator::validate(request()->all(), [
            'stadiumId' => 'required|exists:stadiums,id',
            'homeTeamId' => 'required|exists:teams,id',
            'awayTeamId' => 'required|exists:teams,id',
            'date' => 'date',
            'time' => 'date_format:H:i',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors([$validator->errors()->first()])->withInput();
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
