@extends('home')
@section('content')

    <div class="view__container">
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="position:fixed; top:5rem">
                <strong>{{$errors->first()}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <span class="view__container__title">ABM Tickets</span>
        <hr />
        <div class="view__container__table-container">
            <form method="GET" class="view__container__table-container__form-select" action="{{ route('tickets.matchgameTickets') }}">
                <label for="matchgameId">Matchgames Available</label>
                <select class="view__container__table-container__form-select__select" name="matchgameId">
                    <option value="-1">Select Matchgame</option>
                    @foreach ($matchgames as $matchgame)
                    @if($matchgame->deleted_at)
                        <option style="color: var(--notification-light-color);" value="{{ $matchgame->id }}">{{ $matchgame->id }} - {{ $matchgame->teamsPlayingMatch[0]->team->team_name }} vs {{ $matchgame->teamsPlayingMatch[1]->team->team_name }} | {{ $matchgame->played_on_date }}</option>    
                        @else
                        <option style="color: var(--price-color);" value="{{ $matchgame->id }}">{{ $matchgame->id }} - {{ $matchgame->teamsPlayingMatch[0]->team->team_name }} vs {{ $matchgame->teamsPlayingMatch[1]->team->team_name }} | {{ $matchgame->played_on_date }}</option>
                        @endif
                    @endforeach
                </select>
                <button class="select-button" type="submit" onclick="">Show Tickets from Matchgame</button>
            </form>
            <form method="GET" action="{{ route('tickets.create') }}">
                    @csrf
                    @method('GET')
                    <button class="function-button" type="submit" onclick="">Create Ticket</button>
            </form>
            <table class="view__container__table-container__table">
                <thead class="view__container__table-container__table__head">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Matchgame</th>
                    <th scope="col">Stadium Zone</th>
                    <th scope="col">Category</th>
                    <th scope="col">Base Price</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                </tr>
                </thead>
                <tbody class="view__container__table-container__table__body">
                @foreach ($tickets as $ticket)
                    <tr class="view__container__table-container__table__item">
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->matchgame->teamsPlayingMatch[0]->team->team_name }} vs {{ $ticket->matchgame->teamsPlayingMatch[1]->team->team_name }}</td>
                        <td>{{ $ticket->zone->stadium_location }}</td>
                        <td>{{ $ticket->category }}</td>
                        <td style="color: var(--price-color);">$ {{ $ticket->base_price }}</td>
                        <td>{{ $ticket->created_at }}</td>
                        <td>{{ $ticket->updated_at }}</td>
                        <td>
                            @if($ticket->deleted_at)
                                <label class="text-danger">Deleted</label>
                            @else
                                <label class="text-success">Active</label>
                            @endif
                        </td>

                        <td>
                            @if(!$ticket->deleted_at)
                            <form method="POST" action="{{ route('tickets.delete', $ticket->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="table-button" type="submit" onclick="return confirm('Are you sure you want to delete this Ticket?')">Delete</button>
                            </form>
                            @endif
                        </td>
                        <td>
                            @if(!$ticket->deleted_at)
                            <form method="GET" action="{{ route('tickets.edit', $ticket->id) }}">
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
            <div class="view__pagination">{{$tickets->appends(['matchgameId' => request('matchgameId')])->onEachSide(1)->links()}}</div>
        </div>
    </div>
@endsection


