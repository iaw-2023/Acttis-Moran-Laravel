<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TicketViewController extends HomeController
{
    public function index(){
        $tickets = Ticket::all();
        return view('tickets',['tickets' => $tickets]);
    }


}
