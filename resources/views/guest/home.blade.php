@extends('layouts.guest')

@section('content')
<div class="container-fluid">
    <h2>Views dinamiche con vue</h2>
    {{-- CHECKBOX TYPES --}}
    <div>
      <h3>Select your type</h3>
      <div class="filter">
          <select @change="getSelectedRestaurants()" v-model="selected_type" id="type-filter">
              <option value="">All types</option>
              <option v-for="type in types" :value="type.id">
                @{{type.type}}
              </option>
          </select>
          <button @click="showAllRestaurants()" type="button" name="button">Show all</button>
      </div>
    </div>
    {{-- RESTAURANTS CARDS --}}
    <div v-if="selected_type == ''">
      <h3>Restaurants list</h3>
      <ul>
        <li v-for="restaurant in restaurants">
          @{{restaurant.restaurant_name}}
        </li>
      </ul>
    </div>
    <div v-else>
      <h3>Filtered Restaurants by types</h3>
      <ul>
        <li v-for="restaurant in restaurants">
          @{{restaurant.restaurant_name}}
        </li>
      </ul>
    </div>
</div>
@endsection
