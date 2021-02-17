@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card no-border mt-3 border-radius-top">
                <div class="card-header card-header text-center no-border border-radius-top">
                    Elenco ristoranti.
                </div>
                <ul class="list-group overflow-auto my-2 mx-2 no-border">
                    @foreach ($restaurants as $restaurant)
                        <li class="list-group-item no-border">
                            <a href="{{ route('admin.restaurants.show', ['restaurant' => $restaurant->id]) }}">
                                {{$restaurant->restaurant_name}}
                            </a>
                        </li>
                        <li class="list-group-item no-border">
                            <img src="{{ asset('images/' . $restaurant->img_path_rest)}}" alt="{{$restaurant->restaurant_name}}">
                        </li>
                    @endforeach
                </ul>
                <a href="{{route('admin.restaurants.create')}}" class="btn btn-primary my-3 mx-3">
                    Nuovo ristorante
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
