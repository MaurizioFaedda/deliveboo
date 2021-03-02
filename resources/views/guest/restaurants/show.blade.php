@extends('layouts.guest')

{{-- titolo --}}
@section("page-title", "Deliveboo | Restaurant")

@section('content')
{{-- Restaurant infos --}}
<div class="container mt-5">
    <div class="row d-flex pb-5">
        <div class="col-md-8 d-flex flex-column justify-content-center">
            <h3 class="pl-3"><span class="ml-1 icon-restaurant-main-color pr-3"></span>{{$restaurant->restaurant_name}}</h3>
            <ul class="list-group shadow">
                <li class="list-group-item border-0"><span class="icon-address-main-color pr-3"></span>{{$restaurant->address}}, {{$restaurant->city}}</li>
                <li class="list-group-item border-0">

                    <span class="icon-tags-main-color pr-4"></span>@forelse ($restaurant->types as $type){{$type->type}}</span>{{!$loop->last ? ',' : ''}}
                    @empty
                        <span>Non sono state inserite tipologie</span>
                    @endforelse
                </li>
                <li class="list-group-item h-100 border-0">
                    <span class="icon-info-main-color ml-2 pr-3"></span>
                    {{$restaurant->description}}
                </li>

            </ul>

        </div>
        <div class="col-md-4">
            <div class="restaurant-details">
                <div class="img-restaurant w-100 shadow">
                    <img class="w-100" src="{{asset('storage/' . $restaurant->img_path_rest)}}" alt="{{$restaurant->restaurant_name}} picture">
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

                                        <button type="button" class="btn btn-light btn-dish d-flex justify-content-between align-items p-0 h-100" data-toggle="modal" data-target="#{{ str_replace([" ", "&", ",", "'"], '', $dish->name) }}">
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
                                                        <p class="mb-0 pt-2">
                                                          <strong>Price:</strong>
                                                          € {{number_Format($dish->price, 2, ',', '')}}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                                    {{-- BUTTON per carrello Vue (front-end)--}}
                                                    <button  type="button" data-dismiss="modal" @click="addItemCart({{$dish->id}})" class="btn my-button-success">Add to Cart</button>
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
                    {{-- Lista elementi visualizzati nel carrello Vue (front-end) --}}
                    <div v-if="cart_list.length > 0" class="">
                      <table class="table bg-white">
                        <thead>
                          <tr class="w-100">
                            <th class="w-50 text-left" scope="col">Dish</th>
                            <th class="w-25 text-left pl-0" scope="col">Price</th>
                            <th class="w-25 text-left pl-0" scope="col">Quantity</th>
                          </tr>
                        </thead>
                        <tbody class="pr-0 overflow-hidden">
                          <tr v-for="(dish, index) in cart_list" :key="dish.id">
                              <td class="w-50 text-left">@{{dish.name}}</td>
                              <td class="w-25 text-left">@{{dish.price.toFixed(2)}} €</td>
                              <td class="w-100 d-flex text-left justify-content-between"><input class="w-75" v-model="dish.qnty" @change="changeQuantity(dish.qnty, index)" @click="getTotalPrice()" class="quantity" type="number" id="quantity" :value="dish.qnty" name="quantity" min="1" max="100"><span class="icon-delete-danger w-25 pl-2" @click="removeItemCart(index, dish)"></span></td>
                          </tr>
                        </tbody>
                      </table>
                      <h5 class="text-dark text-right pr-2">Total: @{{totalPrice.toFixed(2)}} €</h5>
                      <div class="d-flex justify-content-end pt-3">
                          <button @click="removeAllCartShow()" class="btn btn-outline-danger mr-3" type="button">Empty cart</button>
                          <a href="{{url('/cart')}}" class="btn my-button-success" role="button">Checkout</a>
                      </div>
                  </div>
                  <div v-else>
                      <h5 class="text-secondary">Empty cart</h5>
                  </div>
              </div>
            </div>
    </div>
</div>
<div class="">

</div>
@endsection
