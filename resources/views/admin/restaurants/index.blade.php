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
                    {{$restaurant->restaurant_name}}
                  </li>
                @endforeach
              </ul>
            </div>
          </div>
      </div>
    </div>
  </div>
@endsection
