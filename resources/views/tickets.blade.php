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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createTicketModal">Create Ticket</button>
                        <!-- Modal para crear un nuevo ticket -->
                        <div class="modal fade" id="createTicketModal" tabindex="-1" role="dialog" aria-labelledby="createTicketModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('tickets.store') }}">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="createTicketModalLabel">Create Ticket</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="zone_id">Zone ID</label>
                                                <input type="text" class="form-control" id="zone_id" name="zone_id" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="base_price">Base Price</label>
                                                <input type="text" class="form-control" id="base_price" name="base_price" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="matchgame_id">MatchGame ID</label>
                                                <input type="text" class="form-control" id="matchgame_id" name="matchgame_id" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Create</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div></th>
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
                                                        <input type="text" class="form-control" id="zone_id" name="zone_id" value="{{ $ticket->zone_id }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="base_price">Base Price</label>
                                                        <input type="text" class="form-control" id="base_price" name="base_price" value="{{ $ticket->base_price }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="matchgame_id">MatchGame ID</label>
                                                        <input type="text" class="form-control" id="matchgame_id" name="matchgame_id" value="{{ $ticket->matchgame_id }}">
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

