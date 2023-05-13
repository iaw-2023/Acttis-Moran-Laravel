@extends('home')
@section('content')

    <div class="view__container">
        <span class="view__container__title">ABM Matchgames</span>
        <hr />
        <div class="view__container__table-container">
            <form method="GET" action="{{ route('matchgames.create') }}">
                    @csrf
                    @method('GET')
                    <button class="function-button" type="submit" onclick="">Create Matchgame</button>
            </form>
            <table class="view__container__table-container__table">
                <thead class="view__container__table-container__table__head">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Home Team</th>
                    <th scope="col">Away Team</th>
                    <th scope="col">Stadium</th>
                    <th scope="col">Played on Date</th>
                    <th scope="col">Played on Time</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                </tr>
                </thead>
                <tbody class="view__container__table-container__table__body">
                @foreach ($matchgames as $matchgame)
                    <tr class="view__container__table-container__table__item">
                        <td>{{ $matchgame->id }}</td>
                        <td>{{ $matchgame->teamsPlayingMatch[0]->team->team_name }}</td>
                        <td>{{ $matchgame->teamsPlayingMatch[1]->team->team_name }}</td>
                        <td>{{ $matchgame->stadium->stadium_name }}</td>
                        <td>{{ $matchgame->played_on_date }}</td>
                        <td>{{ $matchgame->played_on_time }}</td>
                        <td>{{ $matchgame->created_at }}</td>
                        <td>{{ $matchgame->updated_at }}</td>
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
                                    <button class="table-button" type="submit" onclick="return confirm('Are you sure you want to delete this Matchgame?')">Delete</button>
                            </form>
                            @endif
                        </td>
                        <td>
                            @if(!$matchgame->deleted_at)
                            <form method="GET" action="{{ route('matchgames.edit', $matchgame->id) }}">
                                    @csrf
                                    @method('GET')
                                    <button class="table-button" type="submit" onclick="">Edit</button>
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


