<?php

namespace App\Http\Controllers\Auth;

use App\Http\Resources\ZoneResource;
use App\Models\Matchgame;
use App\Models\TeamPlayingMatch;
use App\Models\Ticket;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Validation\DataValidator;

class TicketViewController extends HomeController
{
    public function index()
    {
        $tickets = Ticket::orderBy('id')->paginate(20);
        $matchgames = MatchGame::withTrashed()->get();
        return view('ticketsIndex', compact('tickets'),
                compact('matchgames')
        );
    }

    public function delete($ticketId)
    {
        request()->merge(['ticketId' => request()->route('ticketId')]);

        $validator = DataValidator::validateTicketID(request()->all());

        if($validator->fails()){
            return redirect()->back()->withErrors([$validator->errors()->first()])->withInput();
        }

        $ticket = Ticket::find($ticketId);

        if(!$ticket)
            return redirect()->back()->withErrors(["Ticket not found"])->withInput();
        
        $ticket->delete();
        
        return redirect()->back()->with('success', 'Ticket deleted successfully.');
    }

    public function update(Request $request, $ticketId)
    {
        request()->merge(['ticketId' => request()->route('ticketId')]);

        $validator = DataValidator::validate(request()->all(), [
            'ticketId' => 'required|exists:tickets,id',
            'price' => 'required|integer|min:1|max:10000',
            'zoneId' => 'required|exists:zones,id',
            'category' => 'string',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors([$validator->errors()->first()])->withInput();
        }

        $ticket = Ticket::find($ticketId);

        $ticket->base_price = $request->price;
        $ticket->zone_id = $request->zoneId;
        $ticket->category = $request->category;

        $ticket->save();

        return redirect("/tickets/index")->with('success', 'Matchgame updated successfully.');
    }

    public function store(Request $request)
    {
        $validator = DataValidator::validate(request()->all(), [
            'matchgameId' => 'required|exists:matchgames,id',
            'zoneId' => 'required|exists:zones,id',
            'price' => 'required|integer|min:1|max:10000',
            'category' => 'string',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors([$validator->errors()->first()])->withInput();
        }
        
        $ticket = Ticket::factory()->state(['category' => $request->category , 'base_price' => $request->price])->create();
        $ticket->zone_id = $request->zoneId;

        $ticket->save();

        return redirect("/tickets/index")->with('success', 'Ticket created successfully.');
    }

    public static function getMatchGameData() {
        $matchgames = \App\Models\MatchGame::all();

        $data = [];

        foreach ($matchgames as $matchgame) {
            $teams_playing_match = \App\Models\TeamPlayingMatch::where('matchgame_id', $matchgame->id)->get();
            $home_team = null;
            $away_team = null;

            foreach ($teams_playing_match as $team_playing_match) {
                if ($team_playing_match->condition == 'home') {
                    $home_team_id = $team_playing_match->team_id;
                    $home_team = \App\Models\Team::where('id', $home_team_id)->first();
                } else {
                    $away_team_id = $team_playing_match->team_id;
                    $away_team = \App\Models\Team::where('id', $away_team_id)->first();
                }
            }

            $data[] = [
                'id' => $matchgame->id,
                'home_team_name' => $home_team->team_name,
                'away_team_name' => $away_team->team_name
            ];
        }

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param int $matchgameId
     */
    public function showZonesByMatchGameID($matchgameId)
    {
        $matchgame = Matchgame::findOrFail($matchgameId);
        $stadium_id = $matchgame->stadium_id;
        $zones = Zone::where('stadium_id',$stadium_id)->get();

        return ZoneResource::collection($zones);
    }

    public function showZones()
    {
        $zones = Zone::all();
        return ZoneResource::collection($zones);
    }

    public static function getZone($zones,$zoneId){
        $zone = $zones->where('id',$zoneId)->first();
        return $zone;
    }

    public function showCreatePage(){

        $matchgames = MatchGame::all();

        return view('ticketsCreate',compact('matchgames'));
    }

    public function showEditPage($ticketId){
        request()->merge(['ticketId' => request()->route('ticketId')]);

        $validator = DataValidator::validateTicketID(request()->all());

        if($validator->fails()){
            return redirect()->back()->withErrors([$validator->errors()->first()])->withInput();
        }

        $ticket = Ticket::find($ticketId);

        if(!$ticket)
            return redirect()->back()->withErrors(["Ticket not found"])->withInput();

        $stadiumZones = $ticket->matchgame->stadium->zones;
        return view('ticketsEdit',
                [
                    'ticket' => $ticket,
                    'stadiumZones' => $stadiumZones,
                ]
        );
    }

    public function matchgameTickets(Request $request){

        $validator = DataValidator::validateMatchgameID($request->all());

        if($validator->fails()){
            return redirect()->back()->withErrors([$validator->errors()->first()])->withInput();
        }
        
        $tickets = Ticket::orderBy('id')->where('matchgame_id', $request->matchgameId)->withTrashed()->paginate(20);
        
        $matchgames = Matchgame::withTrashed()->get();
        
        return view('ticketsIndex', compact('tickets'), compact('matchgames'));
    }
}
