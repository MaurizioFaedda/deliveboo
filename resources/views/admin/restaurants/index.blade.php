@extends('layouts.dashboard')

{{-- titolo --}}
@section("page-title", "Deliveboo | Restaurants")

@section('content')
<div class="container">
    <div class="row">
        <h5 class="card-title h4 my-shadow nunito font-weight-bold text-uppercase p-3 color_main mb-5 w-100 d-flex justify-content-center mx-3">Your Restaurants</h5>
        <div class="col-md-4 col-sm-12">
            <a href="{{route('admin.restaurants.create')}}" class="btn btn-primary rounded-0 color_main nunito font-weight-bold m-3 my-shadow mx-auto border-0 w-100">
                    Create new restaurant
            </a>
        </div>
    </div>

    <div class="row justify-content-left">
        @foreach ($restaurants as $restaurant)
         <div class="col-sm-12 col-md-4 card-restaurant mb-5">
            <div class="card my-4 w-100 h-100 no-border my-shadow p-2 px-3 rounded-top">
              <a class="h-50" href="{{ route('admin.restaurants.show', ['restaurant' => $restaurant->id]) }}">
                @if($restaurant->img_path_rest)
                    <img class="card-img-top p-2 img-fluid h-100" src="{{ asset('storage/' . $restaurant->img_path_rest)}}" alt="{{$restaurant->restaurant_name}}">
                @else
                    <img class="card-img-top p-2 img-fluid h-100" src="{{ asset('img/img_not_available.png')}}" alt="Default image">
                @endif
              </a>
                <div class="card-body pl-0 pb-0">
                    <h5 class="card-title nunito font-weight-bold pl-3 m-0 h-25 d-flex align-items-center"><span class="icon-restaurant-main-color"></span> {{$restaurant->restaurant_name}}</h5>
                    <p class="card-text nunito p-infos pl-3 pt-1">
                    {{$restaurant->description}}
                    </p>
                    <a href="{{ route('admin.restaurants.show', ['restaurant' => $restaurant->id]) }}" class="btn my-button-success nunito m-1 ml-3">Show more</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- <div class="row justify-content-left">
        @foreach ($restaurants as $restaurant)
            <div class="col-md-6">
                <div class="card my-4 my-shadow border-0">
                    @if($restaurant->img_path_rest)
                        <a href="{{ route('admin.restaurants.show', ['restaurant' => $restaurant->id]) }}">
                            <img class="card-img-top img-fluid custom-height p-4" src="{{ asset('storage/' . $restaurant->img_path_rest)}}" alt="Card image cap" alt="{{$restaurant->restaurant_name}}">
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
</div> --}}
@endsection
