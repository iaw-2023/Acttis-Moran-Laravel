@extends('home')
@section('content')

    <div id="test">
        <div>ABM Matchgames</div>
        <hr />
        <div class="table-responsive">
            <form method="GET" action="{{ route('matchgames.create') }}">
                    @csrf
                    @method('GET')
                    <button class="btn btn-primary" type="submit" onclick="">Create Matchgame</button>
            </form>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Home Team</th>
                    <th scope="col">Away Team</th>
                    <th scope="col">Stadium</th>
                    <th scope="col">Played on Date</th>
                    <th scope="col">Played on Time</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($matchgames as $matchgame)
                    <tr id="matchgame_id{{$matchgame->id}}">
                        <td>{{ $matchgame->id }}</td>
                        <td>{{ $matchgame->created_at }}</td>
                        <td>{{ $matchgame->updated_at }}</td>
                        <td>{{ $matchgame->teamsPlayingMatch[0]->team->team_name }}</td>
                        <td>{{ $matchgame->teamsPlayingMatch[1]->team->team_name }}</td>
                        <td>{{ $matchgame->stadium->stadium_name }}</td>
                        <td>{{ $matchgame->played_on_date }}</td>
                        <td>{{ $matchgame->played_on_time }}</td>
                        <td>
                            @if($matchgame->deleted_at)
                                <label class="text-danger">Deleted</label>
                            @else
                                <label class="text-success">Active</label>
                            @endif
                        </td>

                        <td>
                            @if(!$matchgame->deleted_at)
                            <form method="POST" action="{{ route('matchgames.delete', $matchgame->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-primary" type="submit" onclick="return confirm('Are you sure you want to delete this Matchgame?')">Delete</button>
                            </form>
                            @endif
                        </td>
                        <td>
                            @if(!$matchgame->deleted_at)
                            <form method="GET" action="{{ route('matchgames.edit', $matchgame->id) }}">
                                    @csrf
                                    @method('GET')
                                    <button class="btn btn-primary" type="submit" onclick="">Edit</button>
                            </form>
                            @endif
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="matchgame__pagination">{{$matchgames->onEachSide(1)->links()}}</div>
        </div>
    </div>
@endsection


