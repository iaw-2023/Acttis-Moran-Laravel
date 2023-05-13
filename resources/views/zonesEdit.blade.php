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
        <div class="create-view__body">
            
                <form class="create-view__content" method="POST" action="{{ route('zones.update', $zone->id ) }}">
                    @csrf
                    @method('PUT')
                    <span class="view__container__title">
                        Edit Zone
                    </span>
                    <div class="create-view__content__body">
                        <label class="view-label" for="priceAddition">Zone price addition to ticket price</label>
                        <input type="number" class="create-view__content__body__form-item" name="priceAddition">
                    </div>
                    <div class="matchgame__edit__content__footer">
                        <button type="submit" class="function-button">Save changes</button>
                    </div>
                </form>
            
        </div>
    </div>
@endsection