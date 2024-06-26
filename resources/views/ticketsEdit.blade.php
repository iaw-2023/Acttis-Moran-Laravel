@extends('home')
@section('content')

    <div class="create-view__container">
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="position:fixed; top:5rem">
                <strong>{{$errors->first()}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <span class="view__container__title">
            Edit Ticket
        </span>
        <div class="create-view__body">
                <form class="create-view__content" method="POST" action="{{ route('tickets.update', $ticket->id ) }}">
                    @csrf
                    @method('PUT')
                    <div class="edit-view__info">
                        <span>Ticket information</span>
                        <span>ID - {{$ticket->id}}</span>
                        <span>Matchgame - {{$ticket->matchgame->teamsPlayingMatch[0]->team->team_name }} vs {{ $ticket->matchgame->teamsPlayingMatch[1]->team->team_name}}</span>
                        <span>Actual category - {{$ticket->category}}</span>
                        <span>Actual Base Price - {{$ticket->base_price}}</span>
                        <span>Actual Stadium Zone - {{$ticket->zone->stadium_location}}</span>
                    </div>
                    <div class="create-view__content__body">
                       
                        <div class="create-view__content__body__form-group">
                            <label class="view-label" for="zoneId">Stadium Zones</label>
                            <select class="create-view__select" id="zoneId" name="zoneId">
                                <option value="-1">Change Stadium Zone</option>
                                @foreach ($stadiumZones as $zone)
                                <option value="{{ $zone->id }}">{{ $zone->id }} - {{ $zone->stadium_location }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="create-view__content__body__form-group">
                            <label class="view-label" for="price">Ticket base price</label>
                            <input type="number" class="create-view__content__body__form-item__text" name="price">
                        </div>
                        <div class="create-view__content__body__form-group">
                            <label class="view-label" for="category">Ticket category</label>
                            <select class="create-view__select" id="category" name="category">
                                <option value="-1">Select Category</option>
                                <option value="Basic">Basic</option>
                                <option value="Economic">Economic</option>
                                <option value="Premium">Premium</option>
                            </select>
        
                        </div>

                    </div>
                    <div class="create-view__content__footer">
                        <button type="submit" class="function-button">Save changes</button>
                    </div>
                </form>
            
        </div>
    </div>
@endsection