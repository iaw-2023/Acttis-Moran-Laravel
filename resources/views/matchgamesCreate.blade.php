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
        <div class="create-view__body">         
                <form class="create-view__content" method="POST" action="{{ route('matchgames.store') }}">
                    @csrf
                    @method('POST')
                    <span class="view__container__title">
                        Create Matchgame
                    </span>
                    <div class="create-view__content__body">
                        <div class="create-view__content__body__form-item">
                            <label class="view-label" for="stadiumId">Stadium where matchgame is played</label>
                            <select class="create-view__select" id="stadiumId" name="stadiumId">
                                <option value="-1">Select Stadium</option>
                                @foreach ($stadiums as $stadium)
                                <option value="{{ $stadium->id }}">{{ $stadium->id }} - {{ $stadium->stadium_name }}</option>
                                @endforeach
                            </select>
        
                        </div>
                        <label class="view-label" for="date">Date when matchgame is played</label>
                        <input type="date" class="create-view__content__body__form-item__date" name="date">
                        <label class="view-label" for="time">Time when matchgame is played</label>
                        <input type="time" class="create-view__content__body__form-item__time" name="time">
                        <div class="create-view__content__body__form-item">
                            <label class="view-label" for="homeTeamId">Home Team of matchgame</label>
                            <select class="create-view__select" name="homeTeamId">
                                <option value="-1">Select Home Team</option>
                                @foreach ($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->id }} - {{ $team->team_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="create-view__content__body__form-item">
                            <label class="view-label" for="awayTeamId">Away Team of matchgame</label>
                            <select class="create-view__select" name="awayTeamId">
                                <option value="-1">Select Away Team</option>
                                @foreach ($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->id }} - {{ $team->team_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="matchgame__create__content__footer">
                        <button type="submit" class="function-button">Save changes</button>
                    </div>
                </form>
            
        </div>
    </div>
@endsection