@extends('app')

@section('nav')
    <li class="nav-item">
        <form class="float-left" id="tickets-form" action="{{ route('tickets') }}" method="GET" style="display: none;">
            @csrf
        </form>
        <button class="btn btn-primary nav__item__button" onclick="event.preventDefault(); document.getElementById('tickets-form').submit();">Tickets</button>
    </li>
    <li class="nav-item">
        <form id="matchs-form" action="{{ route('matchgames.index') }}" method="GET" style="display: none;">
            @csrf
        </form>
        <button class="btn btn-primary nav__item__button" onclick="event.preventDefault(); document.getElementById('matchs-form').submit();">Matchs</button>
    </li>
    <li class="nav-item">
        <form id="zones-form" action="{{ route('zones.index') }}" method="GET" style="display: none;">
            @csrf
        </form>
        <button class="btn btn-primary nav__item__button" onclick="event.preventDefault(); document.getElementById('zones-form').submit();">Zones</button>
    </li>
    <li class="nav-item-logout">
        <form class="ml-auto" id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <button class="btn btn-dark nav__item-logout__button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</button>
    </li>

@endsection


