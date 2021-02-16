@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card no-border border-radius-top font-weight-bold mb-4 mt-3">
                    <div class="card-header text-center no-border border-radius-top font-weight-bold">
                        Ristorante {{$restaurant->restaurant_name}}
                    </div>
                    <div class="card-body d-flex flex-column align-items-center">
                        <ul class="list-group custom-list overflow-auto">
                            @forelse ($restaurant->dishes as $dish)
                                <li class="list-group-item d-flex justify-content-between no-border">
                                    <a class="text-uppercase" href="#">{{ $dish->name }}{{ !$loop->last ? ',' : '.' }}</a>
                                </li>
                            @empty
                                -
                            @endforelse
                        </ul>
                        <a class="mb-3 py-2 px-2" href="{{ route('admin.dishes.create', ['restaurant' => $restaurant->id])}}">
                            Create a new dish
                        </a>
                        <form class="mt-3" action="{{route('admin.restaurants.destroy', ['restaurant' => $restaurant->id])}}" method="POST">
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
