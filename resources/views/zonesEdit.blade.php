@extends('home')
@section('content')

    <div id="matchgame__edit__container">
        <div class="matchgame__edit__body">
            <div class="matchgame__edit__content">
                <form method="POST" action="{{ route('zones.update', $zone->id ) }}">
                    @csrf
                    @method('PUT')
                    <div class="matchgame__edit__content__header">
                        <h5 class="modal-title">Edit Zone</h5>
                    </div>
                    <div class="matchgame__edit__content__body">
                        <input type="text" class="matchgame__edit__content__body__form-group" name="priceAddition">
                    </div>
                    <div class="matchgame__edit__content__footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection