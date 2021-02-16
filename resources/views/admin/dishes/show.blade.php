@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="card">
            <button type="button" name="button">
                <a href="{{ route('admin.restaurants.show', ['restaurant' => $restaurant]) }}">
                    Torna indietro al ristorante
                </a>
            </button>
            <p>
                {{ $dish->name}}
            </p>
            <p>
                {{ $dish->infos}}
            </p>
            <p>
                {{ $dish->price}}
            </p>
            <p>
                {{ $dish->visibile}}
            </p>
        </div>
    </div>
@endsection
