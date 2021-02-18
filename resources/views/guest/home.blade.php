@extends('layouts.guest')

@section('content')
<div class="container-fluid">
    <h2>Views dinamiche con vue</h2>
    {{-- CHECKBOX TYPES --}}
    <div>
      <h3>Restaurant types list</h3>
      <ul>
        <li v-for="type in types">
          @{{type.type}}
        </li>
      </ul>
    </div>
    {{-- RESTAURANTS CARDS --}}
    <div>
      <h3>Restaurant list</h3>
      <ul>
        <li v-for="restaurant in restaurants">
          @{{restaurant.restaurant_name}}
        </li>
      </ul>
    </div>
</div>
@endsection
