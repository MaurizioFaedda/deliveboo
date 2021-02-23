@extends('layouts.guest')

{{-- titolo --}}
@section("page-title", "Deliveboo | Restaurant")

@section('content')
{{-- Restaurant infos --}}
<div class="container mt-5">
    <div class="row d-flex pb-5">
        <div class="col-md-8 d-flex flex-column justify-content-center">
            <h3 class="pl-3"><span class="ml-1 icon-restaurant-main-color pr-3"></span>{{$restaurant->restaurant_name}}</h3>
            <ul class="list-group">
                <li class="list-group-item"><span class="icon-address-main-color pr-3"></span>{{$restaurant->address}}, {{$restaurant->city}}</li>
                <li class="list-group-item">

                    <span class="icon-tags-main-color pr-4"></span>@forelse ($restaurant->types as $type){{$type->type}}</span>{{!$loop->last ? ',' : ''}}
                    @empty
                        <span>Non sono state inserite tipologie</span>
                    @endforelse
                </li>
                <li class="list-group-item h-100">
                    <span class="icon-info-main-color ml-2 pr-3"></span>
                    {{$restaurant->description}}
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
</div>
{{-- Menu --}}
<div class="bg-my-light">
    <div class="restaurant-menu">
    <div class="container">
            <div class="row">
                {{-- dish table --}}
                <div class="col-md-8 py-5">
                    <h3><span class="icon-menu-main-color ml-4"></span>Menu</h3>
                    <div class="cards-section my-4 d-flex justify-content-between flex-wrap">
                        @forelse ($restaurant->dishes as $dish)
                            {{-- Se il piatto è disponibile lo visualizzo --}}
                            @if ($dish->visible == 1)

                                    <div class="card-dish bg-white mt-3">

                                        <button type="button" class="btn btn-light btn-dish d-flex justify-content-between align-items p-0" data-toggle="modal" data-target="#{{ str_replace([" ", "&", ",", "'"], '', $dish->name) }}">
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
                                                    <form action="{{ route('cart.store', $dish) }}" method="POST">
                                                       {{ csrf_field() }}
                                                       <input type="hidden" name="id" value="{{$dish->id}}">
                                                       <input type="hidden" name="name" value="{{$dish->name}}">
                                                       <input type="hidden" name="price" value="{{$dish->price}}">
                                                       <input type="hidden" name="restaurant_id" value="{{$dish->restaurant_id}}">
                                                       <button type="submit" class="button button-plain">Add to Cart</button>
                                                   </form>
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
                <div class="col-md-4 py-5 text-right">
                    <h3><span class="icon-cart-main-color"></span>Carts</h3>
                    @if (session()->has('success_message'))
                        <div class="alert alert-success">
                            {{ session()->get('success_message') }}
                        </div>
                    @endif

                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (Cart::count() > 0)
                        <h2>{{ Cart::count() }} item(s) in Shopping Cart</h2>
                        <div class="cart-table-row">
                            @foreach (Cart::content() as $item)
                                <p>
                                    {{ $item->model->name }}
                                </p>
                                <p>
                                    {{number_Format($item->model->price, 2, ',', '')}} €
                                </p>
                            @endforeach
                        </div>
                    @else
                        <h3>No items in Cart!</h3>
                    @endif
                    <a href="{{ route('cart.index')}}">Visuliazza il tuo ordine completo</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="">

</div>
@endsection
