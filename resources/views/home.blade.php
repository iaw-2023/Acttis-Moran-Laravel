@extends('app')

@section('nav')
    
    <div class="nav-item">
        <form class="float-left" id="tickets-form" action="{{ route('tickets.index') }}" method="GET" style="display: none;">
            @csrf
        </form>
        <button class="nav__item__button" onclick="event.preventDefault(); document.getElementById('tickets-form').submit();">Tickets</button>
    </div>
    <div class="nav-item">
        <form id="matchs-form" action="{{ route('matchgames.index') }}" method="GET" style="display: none;">
            @csrf
        </form>
        <button class="nav__item__button" onclick="event.preventDefault(); document.getElementById('matchs-form').submit();">Matchs</button>
    </div>
    <div class="nav-item">
        <form id="zones-form" action="{{ route('zones.index') }}" method="GET" style="display: none;">
            @csrf
        </form>
        <button class="nav__item__button nav__item__button__zones" onclick="event.preventDefault(); document.getElementById('zones-form').submit();">Zones</button>
    </div>
    <div class="nav-item-logout">
        <form class="ml-auto" id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <button class="nav__item-logout__button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</button>
    </div>

@endsection

@section('content')
    <div id="enterprise-logo-container">
        <img id="enterprise-logo-img" src="/logo-youticket.png" />
    </div>
@endsection


