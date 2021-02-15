@extends('layouts.dashboard')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
            <div class="card-header">
              Ristorante {{$restaurant->restaurant_name}}
            </div>
            <div>
                <span>
                    @forelse ($restaurant->dishes as $dish)
                        {{ $dish->name }}{{ !$loop->last ? ',' : '' }}
                    @empty
                        -
                    @endforelse
                </span>
            </div>
            <a href="{{ route('admin.dishes.create', ['restaurant' => $restaurant->id])}}">
                Create a new dish
            </a>
            <form action="{{route('admin.restaurants.destroy', ['restaurant' => $restaurant->id])}}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger text-uppercase">
                Delete restaurant
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
