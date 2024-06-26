@extends('home')
@section('content')

    <div class="create-view__container">
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="position:fixed; top:5rem;">
                <strong>{{$errors->first()}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <span class="view__container__title">
                    Create Ticket
        </span>
        <div class="create-view__body">
            <form class="create-view__content" method="POST" action="{{ route('tickets.store') }}">
                @csrf
                @method('POST')
                <div class="create-view__content__body">
                    <div class="create-view__content__body__form-group">
                        <label class="view-label" for="matchgameId">Matchgame related to Ticket</label>
                        <select class="create-view__select" id="matchgameId" name="matchgameId" onchange="seleccionarMatchGame(this.value)">
                            <option value="-1">Select Matchgame</option>
                            @foreach ($matchgames as $matchgame)
                            <option value="{{ $matchgame->id }}">{{ $matchgame->id }} - {{ $matchgame->teamsPlayingMatch[0]->team->team_name }} vs {{ $matchgame->teamsPlayingMatch[1]->team->team_name }} | {{ $matchgame->played_on_date }}</option>
                            @endforeach
                        </select>

                    </div>
                     
                    <div class="create-view__content__body__form-group">
                        <label for="zoneId">Stadium Zones</label>
                        <select class="create-view__select" id="zoneId" name="zoneId">
                            <option value="-1">Change Stadium Zone</option>
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
                    <button type="submit" class="function-button">Create Ticket</button>
                </div>
            </form>
            
        </div>
    </div>
@endsection