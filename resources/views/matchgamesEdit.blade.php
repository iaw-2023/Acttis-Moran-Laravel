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
            Edit Matchgame
        </span>
        <div class="create-view__body">
                <form class="create-view__content" method="POST" action="{{ route('matchgames.update', $matchgame->id ) }}">
                    @csrf
                    @method('PUT')
                    <div class="edit-view__info">
                        <span>Matchgame information</span>
                        <span>ID - {{$matchgame->id}}</span>
                        <span>Actual Local Team - {{$matchgame->teamsPlayingMatch[0]->team->team_name}}</span>
                        <span>Actual Away Team - {{$matchgame->teamsPlayingMatch[1]->team->team_name}}</span>
                        <span>Actual Date - {{$matchgame->played_on_date}}</span>
                        <span>Actual Time - {{$matchgame->played_on_time}}</span>
                    </div>
                    <div class="create-view__content__body">

                        <div class="create-view__content__body__form-group">
                            <label class="view-label" for="date">Date when matchgame is played</label>
                            <input type="date" class="create-view__content__body__form-item__date" name="date">
                        </div>
                        
                        <div class="create-view__content__body__form-group">
                            <label class="view-label" for="time">Time when matchgame is played</label>
                            <input type="time" class="create-view__content__body__form-item__time" name="time">
                        </div>
                        
                        <div class="create-view__content__body__form-group">
                            <label class="view-label" for="homeTeamId">Home Team</label>
                            <select class="create-view__select" name="homeTeamId">
                                <option value="-1">Change Home Team</option>
                                @foreach ($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->id }} - {{ $team->team_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="create-view__content__body__form-group">
                            <label class="view-label" for="awayTeamId">Away Team</label>
                            <select class="create-view__select" name="awayTeamId">
                                <option value="-1">Change Away Team</option>
                                @foreach ($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->id }} - {{ $team->team_name }}</option>
                                @endforeach
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