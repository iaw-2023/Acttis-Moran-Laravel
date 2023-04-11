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
                    <th scope="col"><button>CREATE</button></th>
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
                        <td><button>DELETE</button></td>
                        <td><button>UPDATE</button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

