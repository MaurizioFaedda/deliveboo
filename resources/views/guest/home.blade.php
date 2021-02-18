@extends('layouts.guest')

@section('content')
<div class="container-fluid">
    <h2>Views dinamiche con vue</h2>
    {{-- CHECKBOX TYPES --}}
    <div>
      <h3>Select your type</h3>
      <div class="filter">
          <select v-model="selected_type" id="type-filter">
              <option value="">All types</option>
              <option v-for="type in types" :value="type.type">
                @{{type.type}}
              </option>
          </select>
          <button @click="show_all()" type="button" name="button">Show all</button>
      </div>
    </div>
    {{-- RESTAURANTS CARDS --}}
    <div v-if="selected_type == ''">
      <h3>Restaurant list</h3>
      <ul>
        <li v-for="restaurant in restaurants">
          @{{restaurant.restaurant_name}}
        </li>
      </ul>
    </div>
    {{-- <div v-else>
      <ul>
        <li v-for="restaurant in restaurants">
          @{{restaurant.restaurant_name}}
        </li>
      </ul>
    </div> --}}
</div>
@endsection
