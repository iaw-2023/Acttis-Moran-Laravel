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
        <span class="view__container__title">Edit Zones</span>
        <hr />
        <div class="view__container__table-container">
            
            <form method="GET" class="view__container__table-container__form-select" action="{{ route('zones.stadiumZones') }}">
                <label for="stadiumId">Stadiums Available</label>
                <select class="view__container__table-container__form-select__select" name="stadiumId">
                    <option value="-1">Select Stadium</option>
                    @foreach ($stadiums as $stadium)
                    <option value="{{ $stadium->id }}">{{ $stadium->id }} - {{ $stadium->stadium_name }}</option>
                    @endforeach
                </select>
                <button class="table-button select-button" type="submit" onclick="">Show Stadium Zones</button>
            </form>
            <table class="view__container__table-container__table">
                <thead class="view__container__table-container__table__head">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Price Addition</th>
                    <th scope="col">Stadium Location</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                </tr>
                </thead>
                <tbody class="view__container__table-container__table__body">
                @foreach ($zones as $zone)
                    <tr class="view__container__table-container__table__item">
                        <td>{{ $zone->id }}</td>
                        <td>$ {{ $zone->price_addition }}</td>
                        <td>{{ $zone->stadium_location }}</td>
                        <td>{{ $zone->created_at }}</td>
                        <td>{{ $zone->updated_at }}</td>
                        <td>
                            <form method="GET" action="{{ route('zones.edit', $zone->id) }}">
                                    @csrf
                                    @method('GET')
                                    <button class="table-button" type="submit" onclick="">Edit</button>
                            </form>    
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="matchgame__pagination">{{$zones->onEachSide(1)->links()}}</div>
        </div>
    </div>
@endsection


