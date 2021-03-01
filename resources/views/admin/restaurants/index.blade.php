@extends('layouts.dashboard')

{{-- titolo --}}
@section("page-title", "Deliveboo | Restaurants")

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="card w-100 my-shadow no-border">
                <a href="{{route('admin.restaurants.create')}}" class="btn btn-primary font-weight-bold m-3 my-shadow mx-auto border-0 w-75">
                    Create a new restaurant
                </a>
            </div>
        </div>
    </div>


    <div class="row justify-content-left">
        @foreach ($restaurants as $restaurant)
            <div class="col-md-6">
                <div class="card my-4 my-shadow border-0">
                    @if($restaurant->img_path_rest)
                        <a href="{{ route('admin.restaurants.show', ['restaurant' => $restaurant->id]) }}">
                            <img class="card-img-top custom-height p-4" src="{{ asset('storage/' . $restaurant->img_path_rest)}}" alt="Card image cap" alt="{{$restaurant->restaurant_name}}">
                        </a>
                    @else
                        <img class="card-img-top" src="{{ asset('img/img_not_available.png')}}" alt="not img">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold text-uppercase p-2">{{$restaurant->restaurant_name}}</h5>
                        <a href="{{ route('admin.restaurants.show', ['restaurant' => $restaurant->id]) }}" class="btn btn-primary w-100 font-weight-bold">Show restaurant</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
