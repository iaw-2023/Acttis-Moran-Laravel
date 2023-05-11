@extends('home')
@section('content')

    <div id="matchgame__edit__container">
        <div class="matchgame__edit__body">
                @if($errors->any())
                <h4>{{$errors->first()}}</h4>
                @endif
            <div class="matchgame__edit__content">
                <form method="POST" action="{{ route('matchgames.update', $matchgame->id ) }}">
                    @csrf
                    @method('PUT')
                    <div class="matchgame__edit__content__header">
                        <h5 class="modal-title">Edit Matchgame</h5>
                    </div>
                    <div class="matchgame__edit__content__body">
                        <!-- 
                        <div class="matchgame__edit__content__body__form-group">
                            <label for="stadiumId">Stadium</label>
                            <select class="form-control" id="stadiumId" name="stadiumId">
                                <option value="-1">Change Stadium</option>
                                @foreach ($stadiums as $stadium)
                                <option value="{{ $stadium->id }}">{{ $stadium->id }} - {{ $stadium->stadium_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        -->
                        <input type="date" class="matchgame__edit__content__body__form-group" name="date">
                        <input type="time" class="matchgame__edit__content__body__form-group" name="time">
                        <div class="matchgame__edit__content__body__form-group">
                            <label for="homeTeamId">Home Team</label>
                            <select class="form-control" name="homeTeamId">
                                <option value="-1">Change Home Team</option>
                                @foreach ($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->id }} - {{ $team->team_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="matchgame__edit__content__body__form-group">
                            <label for="awayTeamId">Away Team</label>
                            <select class="form-control" name="awayTeamId">
                                <option value="-1">Change Away Team</option>
                                @foreach ($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->id }} - {{ $team->team_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="matchgame__edit__content__footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection