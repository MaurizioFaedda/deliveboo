@extends('layouts.dashboard')

{{-- titolo --}}
@section("page-title", "Deliveboo | Restaurants")

@section('content')
<div class="container">
    <div class="card w-25 shadow no-border">
        <a href="{{route('admin.restaurants.create')}}" class="btn btn-primary my-3 shadow mx-auto o-border w-50">
            Nuovo ristorante
        </a>
    </div>

    <div class="row justify-content-left">
            @foreach ($restaurants as $restaurant)
                <div class="col-md-6">
                    <div class="card my-4 shadow">
                        @if($restaurant->img_path_rest)
                            <img class="card-img-top custom-height p-4" src="{{ asset('storage/' . $restaurant->img_path_rest)}}" alt="Card image cap" alt="{{$restaurant->restaurant_name}}">
                        @else
                            <img class="card-img-top" src="{{ asset('img/img_not_available.png')}}" alt="not img">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold text-uppercase">{{$restaurant->restaurant_name}}</h5>
                            <a href="{{ route('admin.restaurants.show', ['restaurant' => $restaurant->id]) }}" class="btn btn-primary w-100">Visualizza ristorante</a>
                        </div>
                    </div>
                </div>
            @endforeach
    </div>
</div>
@endsection
