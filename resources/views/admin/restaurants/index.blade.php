@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card no-border mt-3 border-radius-top shadow d-flex flex-column align-items-center">
                <h2 class="color_main h4 mb-4 py-2 form-font font-weight-bold border-radius-top w-100 py-3 text-center">Elenco dei tuoi ristoranti</h2>
                <div class="card border-0 mb-5 w-75">
                    <div class="card-body shadow p-3">
                        <ul class="list-group overflow-auto my-2 mx-2 no-border">
                            @foreach ($restaurants as $restaurant)
                                <div class="card my-4">
                                    @if($restaurant->img_path_rest)
                                        <img class="card-img-top" src="{{ asset('storage/' . $restaurant->img_path_rest)}}" alt="Card image cap" alt="{{$restaurant->restaurant_name}}">
                                    @else
                                        <img class="card-img-top" src="{{ asset('img/img_not_available.png')}}" alt="not img">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title font-weight-bold">{{$restaurant->restaurant_name}}</h5>
                                        <a href="{{ route('admin.restaurants.show', ['restaurant' => $restaurant->id]) }}" class="btn btn-primary w-100">Visualizza ristorante</a>
                                    </div>
                                </div>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <a href="{{route('admin.restaurants.create')}}" class="btn btn-primary my-3 mx-3 w-75">
                    Nuovo ristorante
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
