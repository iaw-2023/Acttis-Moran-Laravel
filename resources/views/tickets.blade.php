@extends('home')
@section('content')

    <div id="test">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Zone ID</th>
                    <th scope="col">PriceBase</th>
                    <th scope="col">MatchGame ID</th>
                    <th scope="col">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createTicketDropdownModal">Create Ticket</button>

                        <!-- Modal para crear un nuevo ticket con dropdowns -->
                        <div class="modal fade" id="createTicketDropdownModal" tabindex="-1" role="dialog" aria-labelledby="createTicketDropdownModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="createTicketDropdownModalLabel">Create Ticket</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="{{ route('tickets.store') }}">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-matchgame">
                                                <label for="matchgame_id">MatchGame</label>
                                                <select class="form-control" id="matchgame_id" name="matchgame_id" onchange="seleccionarMatchGame(this.value)">
                                                    <option value="-1">Select a Match</option>
                                                    @php
                                                        $matchGameData = \App\Http\Controllers\Auth\TicketViewController::getMatchGameData();
                                                    @endphp
                                                    @foreach ($matchGameData as $matchgame)
                                                        <option value="{{ $matchgame['id'] }}">{{ $matchgame['id'] }} -{{ $matchgame['home_team_name'] }} - {{ $matchgame['away_team_name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="zone_id">Zone ID</label>
                                                <select class="form-control" id="zone_id" name="zone_id">
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="base_price">Base Price</label>
                                                <input type="text" class="form-control" id="base_price" name="base_price" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Create</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->created_at }}</td>
                        <td>{{ $ticket->updated_at }}</td>
                        <td>{{ $ticket->zone_id }}</td>
                        <td>{{ $ticket->base_price}}</td>
                        <td>{{ $ticket->matchgame_id}}</td>
                        <td><form method="POST" action="{{ route('tickets.delete', $ticket->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-primary" type="submit" onclick="return confirm('Are you sure you want to delete this ticket?')">Delete</button>
                            </form>
                        </td>
                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editTicketModal{{ $ticket->id }}">Edit Ticket</button>

                                <div class="modal fade" id="editTicketModal{{ $ticket->id }}" tabindex="-1" role="dialog" aria-labelledby="editTicketModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('tickets.update', $ticket->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editTicketModalLabel">Edit Ticket</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="zone_id">Zone ID</label>
                                                        <label type="text" class="form-control" id="zone_id">{{ $ticket->zone_id }}</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="base_price">Base Price</label>
                                                        <input type="text" class="form-control" id="base_price" name="base_price" value="{{ $ticket->base_price }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="matchgame_id">MatchGame ID</label>
                                                        <label type="text" class="form-control" id="zone_id">{{ $ticket->matchgame_id }}</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

