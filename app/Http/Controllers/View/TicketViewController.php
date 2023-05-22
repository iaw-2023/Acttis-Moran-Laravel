<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Validation\DataValidator;
use App\Http\Resources\ZoneResource;
use App\Models\Matchgame;
use App\Models\Ticket;
use App\Models\Zone;
use Illuminate\Http\Request;

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
        $ticket->matchgame_id = $request->matchgameId;
        $ticket->zone_id = $request->zoneId;

        $ticket->save();

        return redirect("/tickets/index")->with('success', 'Ticket created successfully.');
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
