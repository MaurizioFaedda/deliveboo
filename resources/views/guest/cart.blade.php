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

            <button @click="removeAllCart()" type="button" name="button">Empty</button>
            <div class="">
                <div class="">
                  <ul v-for="(dish, index) in cart_list" :key="dish.id">
                    <li>
                      <span>@{{dish.name}}</span>
                      <span>@{{dish.price.toFixed(2)}} €</span>
                      <input v-model="current_quantity" @change="changeQuantity(dish.id)" class="quantity" type="number" id="quantity" :value="getItemQuantity(dish.id)" name="quantity" min="1" max="10">
                      {{-- <span> @{{getSubTotal(dish.price.toFixed(2),current_quantity)}}  € </span> --}}
                      <button @click="removeItemCart(index)">Remove</button>
                    </li>
                  </ul>
                </div>
            </div>
            <div class="">
                <a v-if="cart_list.length > 0" class="btn btn-link" :href="'restaurant/' + cart_list[0].restaurant_id">Add new Dishes</a>
                <a v-else href="{{route('index')}}">Add new Dishes</a>
            </div>
        </div>

@endsection
