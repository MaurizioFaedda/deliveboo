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
            <div class="row d-flex">
                <div class="col-md-7 text-dark ">
                  {{-- FORM per le informazioni sulla consegna | Backend ORDERS table --}}
                  <form class="bg-white px-4 py-3" action="{{route('orders.store')}}" method="post">
                    @csrf
                      <div class="form-row pb-4">
                          <div class="form-group col-md-6">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{old('first_name')}}" required>
                            {{-- SHOWING ERROR MESSAGE --}}
                            @error('first_name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                          </div>
                          <div class="form-group col-md-6">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control" placeholder="Last Name" name="lastname" value="{{old('lastname')}}" required>
                            {{-- SHOWING ERROR MESSAGE --}}
                            @error('lastname')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                          </div>
                          <div class="form-group col-md-6">
                            <label for="mobile">Phone Number</label>
                            <input type="text" class="form-control" placeholder="e.g. +39 320 000 0000" name="mobile" value="{{old('mobile')}}" required>
                            {{-- SHOWING ERROR MESSAGE --}}
                            @error('mobile')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                          </div>
                          <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" placeholder="example@mail.com" name="email" value="{{old('email')}}" required>
                            {{-- SHOWING ERROR MESSAGE --}}
                            @error('email')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                          </div>
                          <div class="form-group col-md-6">
                            <label>City</label>
                            <input readonly type="text" class="form-control" placeholder="Rome">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" placeholder="Via Italia, 155" name="address" value="{{old('address')}}" required>
                            {{-- SHOWING ERROR MESSAGE --}}
                            @error('address')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                          </div>
                          <div class="form-group col-md-12">
                            <label for="delivery_time">Delivery time</label>
                            <input type="datetime-local" class="form-control" placeholder="The doorbell does not work" name="delivery_time" value="{{old('delivery_time')}}" required>
                            {{-- SHOWING ERROR MESSAGE --}}
                            @error('delivery_time')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                          </div>
                          <div class="form-group col-md-12">
                            <label for="notes">Information for the rider</label>
                            <input type="text" class="form-control" placeholder="The doorbell does not work" name="notes" value="{{old('notes')}}">
                            {{-- SHOWING ERROR MESSAGE --}}
                            @error('notes')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                          </div>
                          {{-- Hidden inputs for backend only --}}
                          <div class="form-group d-none">
                            <label for="restaurant_id">Restaurant</label>
                            <input type="hidden" class="form-control" name="restaurant_id" value="1">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="total_price">Total price</label>
                            <input type="hidden" class="form-control" placeholder="39,00 €" name="total_price" value="39.00">
                          </div>
                          {{-- BUTTON to send data to backend --}}
                          <div class="form-group d-flex justify-content-end">
                              <button type="submit" class="btn btn-success text-uppercase form-font shadow">
                                  Submit
                              </button>
                          </div>
                      </div>
                  </form>
                  <hr>
                  {{-- FORM per le informazioni sul pagamento | Backend PAYMENTS table --}}
                  <form class="bg-white px-4 py-3" method="post">
                    <div class="">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="cc-name">Cardholder Name</label>
                                <input class="form-control"></input>
                                <small class="text-muted">Full name as displayed on card</small>
                                <div class="invalid-feedback">
                                  Name on card is required
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="you@example.com">
                                <div class="invalid-feedback">
                                  Please enter a valid email address for shipping updates.
                                </div>
                            </div>
                        <div class="form-group col-md-6">
                            <label for="cc-number">Credit card number</label>
                            <input placeholder="4111 4111 4111 4111" class="form-control"></input>
                            <div class="invalid-feedback">
                              Credit card number is required
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Expiration</label>
                            <div class="form-control"></div>
                            <div class="invalid-feedback">
                                Expiration date required
                            </div>
                      </div>
                        <div class="form-group col-md-6">
                          <label>CVV</label>
                          <div class="form-control"></div>
                          <div class="invalid-feedback">
                              Security code required
                          </div>
                        </div>
                        <div class="form-group col-md-6">
                          <label>Total price</label>
                          <input readonly class="form-control" placeholder="39,00 €">
                        </div>
                    </div>
                        <hr class="mb-4">
                        <div class="text-center">
                            <button class="btn btn-primary btn-lg" type="submit">Pay</button>
                        </div>
                    </div>
                  </form>
                </div>
                <div class="col-5">
                    <table class="table bg-white">
                      <thead>
                        <tr>
                          <th scope="col">Dish</th>
                          <th scope="col">Price</th>
                          <th scope="col">Quantity</th>
                          <th scope="col">Sub Total</th>
                          <th scope="col">Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(dish, index) in cart_list" :key="dish.id">
                            <td>@{{dish.name}}</td>
                            <td>@{{dish.price.toFixed(2)}} €</td>
                            <td><input @change="changeQuantity(dish.id)" class="quantity" type="number" id="quantity" :value="dish.qnty" name="quantity" min="1" max="10"></td>
                            <td></td>
                            <td>
                              <span class="icon-delete-danger" @click="removeItemCart(index)"></span>
                            </td>

                        </tr>
                      </tbody>
                    </table>
                    <div class="">
                        <a v-if="cart_list.length > 0" class="btn btn-link" :href="'restaurant/' + cart_list[0].restaurant_id">Add new Dishes</a>
                        <a v-else href="{{route('index')}}">Add new Dishes</a>
                    </div>
                    <button @click="removeAllCart()" type="button" name="button">Empty</button>
                </div>
            </div>
        </div>
    </div>
@endsection
