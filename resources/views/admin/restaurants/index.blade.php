@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-left">
            <a href="{{route('admin.restaurants.create')}}" class="btn btn-primary my-3 w-75 shadow mx-auto">
                Nuovo ristorante
            </a>
            @foreach ($restaurants as $restaurant)
                <div class="col-md-6">
                    <div class="card my-4">
                        @if($restaurant->img_path_rest)
                            <img class="card-img-top custom-height" src="{{ asset('storage/' . $restaurant->img_path_rest)}}" alt="Card image cap" alt="{{$restaurant->restaurant_name}}">
                        @else
                            <img class="card-img-top" src="{{ asset('img/img_not_available.png')}}" alt="not img">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">{{$restaurant->restaurant_name}}</h5>
                            <a href="{{ route('admin.restaurants.show', ['restaurant' => $restaurant->id]) }}" class="btn btn-primary w-100">Visualizza ristorante</a>
                        </div>
                    </div>
                </div>
            @endforeach
    </div>
</div>
@endsection
