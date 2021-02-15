@extends('layouts.dashboard')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
            <div class="card-header">
              Ristorante {{$restaurant->restaurant_name}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
