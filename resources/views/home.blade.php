@extends('app')

@section('nav')
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</button>

@endsection


