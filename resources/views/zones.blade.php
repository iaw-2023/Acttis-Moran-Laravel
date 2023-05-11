@extends('home')
@section('content')

    <div id="test">
        <div>Zones</div>
        <hr />
        <div class="table-responsive">
            
            <form method="GET" action="{{ route('zones.stadiumZones') }}">
                @if($errors->any())
                <h4>{{$errors->first()}}</h4>
                @endif
                <label for="stadiumId">Stadiums Available</label>
                <select class="form-control" name="stadiumId">
                    <option value="-1">Select Stadium</option>
                    @foreach ($stadiums as $stadium)
                    <option value="{{ $stadium->id }}">{{ $stadium->id }} - {{ $stadium->stadium_name }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary" type="submit" onclick="">Show Stadium Zones</button>
            </form>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Price Addition</th>
                    <th scope="col">Stadium Location</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($zones as $zone)
                    <tr id="">
                        <td>{{ $zone->id }}</td>
                        <td>{{ $zone->created_at }}</td>
                        <td>{{ $zone->updated_at }}</td>
                        <td>{{ $zone->price_addition }}</td>
                        <td>{{ $zone->stadium_location }}</td>
                        <td>
                            <form method="GET" action="{{ route('zones.edit', $zone->id) }}">
                                    @csrf
                                    @method('GET')
                                    <button class="btn btn-primary" type="submit" onclick="">Edit</button>
                            </form>    
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$zones->onEachSide(1)->links()}}
        </div>
    </div>
@endsection


