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
                    <form class="bg-white px-4 py-3">
                        <div class="form-row pb-4">
                            <div class="form-group col-md-6">
                              <label>First Name</label>
                              <input type="text" class="form-control" placeholder="First Name">
                            </div>
                            <div class="form-group col-md-6">
                              <label>Last Name</label>
                              <input class="form-control" placeholder="Last Name">
                            </div>
                            <div class="form-group col-md-6">
                              <label>Phone Number</label>
                              <input type="text" class="form-control" placeholder="+39 320 000 0000">
                            </div>
                            <div class="form-group col-md-6">
                              <label>Email</label>
                              <input class="form-control" placeholder="example@mail.com">
                            </div>
                            <div class="form-group col-md-6">
                              <label>City</label>
                              <input readonly class="form-control" placeholder="Rome">
                            </div>
                            <div class="form-group col-md-6">
                              <label>Address</label>
                              <input class="form-control" placeholder="Via Italia, 155">
                            </div>
                            <div class="form-group col-md-12">
                              <label>Information for the rider</label>
                              <input class="form-control" placeholder="The doorbell does not work">
                            </div>
                        </div>
                            {{-- </form> --}}
                          {{-- <form class=""> --}}
                          <hr>
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
                            <td><input v-model="dish.qnty" @change="changeQuantity(dish.qnty, index)" @click="getTotalPrice()" class="quantity" type="number" id="quantity" :value="dish.qnty" name="quantity" min="1" max="100"></td>
                            <td>@{{(dish.price * dish.qnty).toFixed(2)}} €</td>
                            <td>
                              <span class="icon-delete-danger" @click="removeItemCart(index)"></span>
                            </td>

                        </tr>
                      </tbody>
                      <h1>@{{totalPrice}}</h1>
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
