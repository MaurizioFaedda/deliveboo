@extends('layouts.guest')

{{-- titolo --}}
@section("page-title", "Deliveboo | Restaurant")

@section('content')
{{-- Restaurant infos --}}
<div class="container">
    <div class="row d-flex pb-5">
        <div class="col-md-8 d-flex flex-column justify-content-center">
            <h3>{{$restaurant->restaurant_name}}</h3>
            <ul class="list-group">
                <li class="list-group-item">{{$restaurant->address}}, {{$restaurant->city}}</li>
                <li class="list-group-item">
                    @forelse ($restaurant->types as $type)
                        <span>{{ $type->type }}</span>{{ !$loop->last ? ',' : '' }}
                    @empty
                        <span>Non sono state inserite tipologie</span>
                    @endforelse
                </li>
                <li class="list-group-item h-100">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                </li>

            </ul>

        </div>
        <div class="col-md-4">
            <div class="restaurant-details">
                <div class="img-restaurant w-100">
                    <img class="w-100 rounded" src="{{asset('storage/' . $restaurant->img_path_rest)}}" alt="{{$restaurant->restaurant_name}} picture">
                </div>
            </div>

        </div>
    </div>
  {{-- Restaurant details --}}
  {{-- MENU --}}
  </div>
{{-- Menu --}}
<div class="bg-my-light">
    <div class="restaurant-menu">
    <div class="container">
            <div class="row">
                {{-- dish table --}}
                <div class="col-md-8 py-5">
                    <h3>Menu</h3>
                    <div class="cards-section my-4 d-flex justify-content-between flex-wrap">
                        @forelse ($restaurant->dishes as $dish)
                            {{-- Se il piatto è disponibile lo visualizzo --}}
                            @if ($dish->visible == 1)

                                    <div class="card-dish bg-white mt-3 d-flex justify-content-between align-items center">

                                                <button type="button" class="btn btn-link d-flex" data-toggle="modal" data-target="#{{ str_replace([" ", "&", ",", "'"], '', $dish->name) }}">
                                                    <div class="w-50 p-2 d-flex flex-column justify-content-center align-items-center">
                                                        <h5 data-target="#title">{{$dish->name}}</h5>
                                                        <span class="text-bold">{{number_Format($dish->price, 2, ',', '')}} €</span>
                                                    </div>
                                                    <div class="img-dish">
                                                        <img class="rounded" src="{{asset('storage/' . $dish->img_path_dish)}}" alt="{{$dish->name}} picture">
                                                    </div>
                                                </button>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="{{ str_replace([' ', '&', ',', "'"], '', $dish->name) }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                    <h3 class="modal-title">{{$dish->name}}</h3>

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body pb-0">
                                                    <div class="img-dish-model w-100 h-50">
                                                        <img class="rounded w-100 h-100" src="{{asset('storage/' . $dish->img_path_dish)}}" alt="{{$dish->name}} picture">
                                                    </div>
                                                    <div class="py-3 d-flex flex-column justify-content-between">
                                                        <p class="mb-0"><strong>Infos:</strong> {{$dish->infos}}</p>
                                                        <p class="mb-0 pt-2"><strong>Price:</strong> € {{$dish->price}}</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Add dish</button>
                                              </div>
                                            </div>
                                      </div>
                                    </div>
                            @endif
                        @empty
                            <li>No dishes available</li>
                        @endforelse
                    </div>

                </div>


                {{-- cart --}}
                <div class="col-md-4">

                </div>
            </div>
        </div>
    </div>
</div>
<div class="">

</div>
@endsection
