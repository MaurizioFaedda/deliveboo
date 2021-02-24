@extends('layouts.guest')

@section('content')
    <div class="mt-5">
        <div class="container text-white my-5">
                    {{-- SUCCESS MESSAGE per l'aggiunta dell'ordine --}}
                    @if (session()->has('success_message'))
                        <div class="alert alert-success">
                            {{ session()->get('success_message') }}
                        </div>
                    @endif
                    {{-- ERROR MESSAGE per l'aggiunta dell'ordine --}}
                    @if (session()->has('error_message'))
                        <div class="alert alert-danger">
                            {{ session()->get('error_message') }}
                        </div>
                    @endif

                    {{-- BUTTON per svuotare il carrello --}}
                    {{-- <a href="{{ route('cart.empty') }}" class="btn btn-danger">
                      Empty cart
                    </a> --}}
                    <button @click="removeAllCart()" type="button" name="button">Empty</button>
                    <div class="">
                        <div class="">
                          <ul v-for="(dish, index) in cart_list">
                            <li>
                              <span>@{{dish.name}}</span>
                              <span>@{{dish.price.toFixed(2)}} €</span>
                              <button @click="removeItemCart(index)">Remove</button>
                            </li>
                          </ul>
                        </div>
                    </div>
                    
                    {{-- @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
                    {{-- @if (Cart::count() > 0)
                      <h2>{{ Cart::count() }} item(s) in Shopping Cart</h2>
                      <div class="cart-table-row">
                              <div class="col-md-8 col-sm-12 h-100">
                                  <div class="card-header backgmain text-center no-border border-radius-top font-weight-bold">
                                      <h5 class="mb-0 text-white">Restaurant Name</h5>
                                  </div>
                                  <table class="table text-center mb-0 bg-white">
                                      <thead>
                                          <tr class="text-left">
                                               <th></th>
                                              <th>Name</th>
                                              <th>Price</th>
                                              <th>Quantity</th>
                                              <th>Sub Total</th>
                                              <th></th>
                                          </tr>
                                      </thead>
                                  </table>
                                  <div class="card rounded-0 no-border shadow overflow-auto">

                                      <table class="table text-center mb-0">

                                          <tbody>
                                               @foreach (Cart::content() as $item)
                                                  <tr class="text-left">
                                                      <td>
                                                          <div class="img-dish w-100">
                                                              <img class="rounded w-100" src="{{asset('storage/' . $item->model->img_path_dish)}}" alt="{{$item->model->img_path_dish}} picture">
                                                          </div>
                                                      </td>
                                                      <td>
                                                          {{ $item->model->name }}
                                                      </td>
                                                      <td>
                                                          {{number_Format($item->model->price, 2, ',', '')}} €
                                                      </td>
                                                      <td>
                                                           <input class="quantity" type="number" id="quantity" value="{{ $item->qty }}" name="quantity" min="1" max="10">
                                                      </td>
                                                      <td>
                                                          {{-- {{number_Format($item->qty * $item->model->price, 2, ',', '' )}} --}}
                                                      {{-- </td>
                                                      <td>
                                                          <form class="" action="{{route('cart.destroy', $item->rowId)}}" method="POST">
                                                              {{ csrf_field() }}
                                                              {{ method_field('DELETE') }}
                                                              <button type="submit" class="btn btn-danger">Remove</button>
                                                          </form>
                                                      </td>
                                                    </tr> --}}
                                                {{-- @endforeach
                                          </tbody>
                                      </table>
                                  </div>
                          </div> --}}
                  {{-- @else --}}
                        {{-- <h3>No items in Cart!</h3>
                        <div class="spacer"></div>
                        <a href="{{route('index')}}" class="button">Continue Shopping</a>
                        <div class="spacer"></div> --}}
                    {{-- @endif
                </div> --}}
        </div>

@endsection
