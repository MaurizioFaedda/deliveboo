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

      @if($dish->img_path_dish)
        <img src="{{ asset('storage/' . $dish->img_path_dish)}}" alt="{{ $dish->name}}">
      @else
        <img src="{{ asset('img/img_not_available.png')}}" alt="{{ $dish->name}} not available">
      @endif
    </div>
  </div>
@endsection
