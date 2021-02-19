@extends('layouts.guest')

{{-- titolo --}}
@section("page-title", "Deliveboo | Restaurant")

@section('content')
<div class="container-fluid">
  <h1>{{$restaurant->restaurant_name}}</h1>
  {{-- Restaurant details --}}
  <div class="restaurant-details">
    <img src="{{asset('storage/' . $restaurant->img_path_rest)}}" alt="{{$restaurant->restaurant_name}} picture">
    <ul>
      <li>{{$restaurant->city}}</li>
      <li>{{$restaurant->address}}</li>
      @forelse ($restaurant->types as $type)
          <li>{{ $type->type }}</li>
      @empty
          <li>Non sono state inserite tipologie</li>
      @endforelse
    </ul>
  </div>
  {{-- MENU --}}
  <div class="restaurant-menu">
    <h2>Menu</h2>
    <ul>
      @forelse ($restaurant->dishes as $dish)
        {{-- Se il piatto è disponibile lo visualizzo --}}
        @if ($dish->visible == 1)
          <li>
            <img src="{{asset('storage/' . $dish->img_path_dish)}}" alt="{{$dish->name}} picture">
          </li>
          <li>{{$dish->name}}</li>
          <li>{{number_Format($dish->price, 2, ',', '')}} €</li>
        @endif
      @empty
          <li>No dishes available</li>
      @endforelse
    </ul>
  </div>
</div>
@endsection
