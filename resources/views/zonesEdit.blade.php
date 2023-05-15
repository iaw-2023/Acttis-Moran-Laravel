@extends('home')
@section('content')

    <div class="create-view__container">
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="position:fixed; top:5rem">
                <strong>{{$errors->first()}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <span class="view__container__title">
            Edit Zone
        </span>
        <div class="create-view__body">
                <form class="create-view__content" method="POST" action="{{ route('zones.update', $zone->id ) }}">
                    @csrf
                    @method('PUT')
                    <div class="edit-view__info">
                        <span>Zone information</span>
                        <span>ID - {{$zone->id}}</span>
                        <span>Actual Price Adittion - {{$zone->price_addition}}</span>
                        <span>Stadium Location - {{$zone->stadium_location}}</span>
                    </div>
                    <div class="create-view__content__body create-view__content__body-zones">
                        <div class="create-view__content__body__form-group">
                            <label class="view-label" for="priceAddition">Zone price addition to ticket price</label>
                            <input type="number" class="create-view__content__body__form-item__text" name="priceAddition">
                        </div>
                    </div>
                    <div class="create-view__content__footer">
                        <button type="submit" class="function-button">Save changes</button>
                    </div>
                </form>
            
        </div>
    </div>
@endsection