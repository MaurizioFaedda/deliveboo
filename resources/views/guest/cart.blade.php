@extends('layouts.guest')

{{-- titolo --}}
@section("page-title", "Deliveboo | Your Cart")

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
                  {{-- <form class="bg-white px-4 py-3" action="{{route('orders.store')}}" method="post"> --}}
                    <form class="bg-white p-3" method="post" id="payment-form" action="{{ url('/checkout')}}">
                        @csrf
                        <div class="form-row pb-4">
                               {{-- SEZIONE per le informazioni degli ORDINI | Backend ORDERS table --}}
                                <div class="form-group col-md-6">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{old('first_name')}}" required maxlength="50">
                                    {{-- SHOWING ERROR MESSAGE --}}
                                    @error('first_name')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" class="form-control" placeholder="Last Name" name="lastname" value="{{old('lastname')}}" required maxlength="50">
                                    {{-- SHOWING ERROR MESSAGE --}}
                                    @error('lastname')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="mobile">Phone Number</label>
                                    <input type="tel" class="form-control" placeholder="e.g. 3201234567" name="mobile" value="{{old('mobile')}}" required maxlength="15">
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
                                    <input type="text" class="form-control" placeholder="The doorbell does not work" maxlength="50" name="notes" value="{{old('notes')}}">
                                    {{-- SHOWING ERROR MESSAGE --}}
                                    @error('notes')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                              {{-- Hidden inputs for backend only --}}
                                <div class="form-group col-md-6">
                                      <input type="hidden" class="form-control" name="total_price" :value="totalPrice.toFixed(2)">
                                </div>
                                <div class="form-group d-none">
                                    <label for="restaurant_id">Restaurant</label>
                                    <input type="hidden" class="form-control" name="restaurant_id" :value="cart_list[0].restaurant_id">
                                </div>
                        </div>
                        <hr>
                          {{-- SEZIONE per le informazioni sul pagamento | Backend PAYMENTS table --}}
                            <div class="form-group col-md-6 p-0">
                              <label for="card_owner"></label>
                              <input type="text" class="form-control" placeholder="Full Name" name="card_owner" value="{{old('card_owner')}}" required maxlength="50">
                              {{-- SHOWING ERROR MESSAGE --}}
                              @error('card_owner')
                                  <div class="alert alert-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
                            </div>
                          {{-- BRAINTREE SECTION --}}
                        <section>
                            <label for="amount">
                             <span class="input-label">Amount</span>
                             <div class="input-wrapper amount-wrapper">
                                 <input id="amount" name="amount" type="tel" min="1" placeholder="Amount" readonly :value="totalPrice.toFixed(2)">
                             </div>
                            </label>

                            <div class="bt-drop-in-wrapper">
                                <div id="bt-dropin"></div>
                            </div>
                        </section>

                        <input id="nonce" name="payment_method_nonce" type="hidden" />
                        <button @click="removeAllCart()" class="btn btn-primary" type="submit"><span>Pay</span></button>
                    </form>
                </div>
                <div v-if="cart_list.length > 0" class="col-5">
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
                  <h5 class="text-dark text-right pr-3">Total: @{{totalPrice.toFixed(2)}} €</h5>
                  <div class="d-flex justify-content-between align-items-center small-text mt-5">
                      <a v-if="cart_list.length > 0" class="btn btn-link small-text" :href="'restaurant/' + cart_list[0].restaurant_id">Add new Dishes</a>
                      <a v-else class="small-text" href="{{route('index')}}">Add new Dishes</a>
                      <a class="text-danger text-right" @click="removeAllCart()"href="{{route('index')}}" type="button" name="button">Delete all and start new order</a>
                  </div>
              </div>
            </div>
        </div>
    </div>
    <script src="https://js.braintreegateway.com/web/dropin/1.26.1/js/dropin.min.js"></script>
    <script>
        var form = document.querySelector('#payment-form');
        var client_token = "{{$token}}";

        braintree.dropin.create({
          authorization: client_token,
          selector: '#bt-dropin',
          paypal: {
            flow: 'vault'
        },
        }, function (createErr, instance) {
          if (createErr) {
            console.log('Create Error', createErr);
            return;
          }
          form.addEventListener('submit', function (event) {
            event.preventDefault();

            instance.requestPaymentMethod(function (err, payload) {
              if (err) {
                console.log('Request Payment Method Error', err);
                return;
              }

              // Add the nonce to the form and submit
              document.querySelector('#nonce').value = payload.nonce;
              form.submit();
            });
          });
        });
    </script>
@endsection
