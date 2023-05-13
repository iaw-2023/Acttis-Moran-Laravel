@extends('home')
@section('content')

    <div class="create-view__container">
        @if($errors->any())
        <h4>{{$errors->first()}}</h4>
        @endif
        <div class="create-view__body">
            
                <form class="create-view__content" method="POST" action="{{ route('zones.update', $zone->id ) }}">
                    @csrf
                    @method('PUT')
                    <span class="view__container__title">
                        Edit Zone
                    </span>
                    <div class="create-view__content__body">
                        <label class="view-label" for="priceAddition">Zone price addition to ticket price</label>
                        <input type="text" class="create-view__content__body__form-item" name="priceAddition">
                    </div>
                    <div class="matchgame__edit__content__footer">
                        <button type="submit" class="function-button">Save changes</button>
                    </div>
                </form>
            
        </div>
    </div>
@endsection