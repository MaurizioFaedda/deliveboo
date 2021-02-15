@extends('layouts.dashboard')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
            <div class="card-header">Elenco ristoranti.</div>
              <ul>
                @foreach ($restaurants as $restaurant)
                  <li>
                    <a href="{{ route('admin.restaurants.show', ['restaurant' => $restaurant->id]) }}">                      
                      {{$restaurant->restaurant_name}}
                    </a>
                  </li>
                @endforeach
              </ul>
              <a href="{{route('admin.restaurants.create')}}" class="btn btn-primary">
                Nuovo ristorante
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
