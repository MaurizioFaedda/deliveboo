@extends('layouts.guest')

@section('content')
<div class="container">
    <h2>Views dinamiche con vue</h2>
    {{-- CHECKBOX FILTER TYPES --}}
    <div>
      <h3>Check your types</h3>
      <div v-for="type in types">
        <input @click="getFilteredRestaurantsByTypes()" type="checkbox" :value="type.id" v-model="checked_types">
        <label for="type.type">
            @{{type.type}}
        </label>
      </div>
    </div>
    {{-- SELECT TYPES --}}
    <div>
      <h3>Select your type</h3>
      <div class="filter">
        <select @change="getFilteredRestaurants()" v-model="selected_type" id="type-filter">
            <option value="">All types</option>
            <option v-for="type in types" :value="type.id">
              @{{type.type}}
            </option>
        </select>
        <button @click="getAllRestaurants()" type="button" name="button">Show all</button>
      </div>
    </div>
    {{-- RESTAURANTS CARDS --}}

    <div class="row">
         <div v-for="restaurant in restaurants" class="col-sm col-md-4">
            <div class="card my-4 w-100 h-25">
                <img v-if="restaurant.img_path_rest" class="card-img-top g-custom-card-height" :src="'storage/' + restaurant.img_path_rest" alt="Card image cap">
                <img v-else class="card-img-top g-custom-card-height" src="" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold"> @{{restaurant.restaurant_name}}</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <a :href="'restaurant/' + restaurant.id" class="btn btn-primary">Visualizza ristorante</a>
                </div>
            </div>
        </div>
    </div>
@endsection
