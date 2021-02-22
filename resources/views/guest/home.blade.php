@extends('layouts.guest')
@section('content')
<div class="container">
    <h2>Views dinamiche con vue</h2>
    {{-- CHECKBOX FILTER TYPES --}}
    <div>
      <h3>Check your types</h3>
      <div v-for="type in types">
        <input @change="getFilteredRestaurantsByTypes()" type="checkbox" :value="type.id" v-model="checked_types">
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


{{-- @extends('layouts.guest')

@section('content')
<div class="container">
    {{-- <div class="row custom_padding">
        <div class="col-sm col-md-3">
            <div class="card custom_padding no-border my-4 shadow">
                <div class="form-group d-flex flex-column align-items-left w-100">
                    <h3>Pizzeria</h3>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-primary">
                            <input type="radio" id="option2" value="1" v-model="pizza_checked"> Mostra
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" id="option3" value="0" v-model="pizza_checked" checked> Non mostrare
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm col-md-3">
            <div class="card custom_padding no-border my-4 shadow">
                <div class="form-group d-flex flex-column align-items-left w-100">
                    <h3>Italian Foods</h3>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-primary">
                            <input type="radio" id="option2" value="1" v-model="italian_checked"> Mostra
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" id="option3" value="0" v-model="italian_checked" checked> Non mostrare
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm col-md-3">
            <div class="card custom_padding no-border my-4 shadow">
                <div class="form-group d-flex flex-column align-items-left w-100">
                    <h3>Sushi</h3>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-primary">
                            <input type="radio" id="option2" value="1" v-model="sushi_checked"> Mostra
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" id="option3" value="0" v-model="sushi_checked" checked> Non mostrare
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm col-md-3">
            <div class="card custom_padding no-border my-4 shadow">
                <div class="form-group d-flex flex-column align-items-left w-100">
                    <h3>Vegan Foods</h3>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-primary">
                            <input type="radio" id="option2" value="1" v-model="vegan_checked"> Mostra
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" id="option3" value="0" v-model="vegan_checked" checked> Non mostrare
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm col-md-3">
            <div class="card custom_padding no-border my-4 shadow">
                <div class="form-group d-flex flex-column align-items-left w-100">
                    <h3>Organic Foods</h3>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-primary">
                            <input type="radio" id="option2" value="1" v-model="organic_checked"> Mostra
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" id="option3" value="0" v-model="organic_checked" checked> Non mostrare
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm col-md-3">
            <div class="card custom_padding no-border my-4 shadow">
                <div class="form-group d-flex flex-column align-items-left w-100">
                    <h3>Street Foods</h3>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-primary">
                            <input type="radio" id="option2" value="1" v-model="street_checked"> Mostra
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" id="option3" value="0" v-model="street_checked" checked> Non mostrare
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm col-md-3">
            <div class="card custom_padding no-border my-4 shadow">
                <div class="form-group d-flex flex-column align-items-left w-100">
                    <h3>Asian Foods</h3>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-primary">
                            <input type="radio" id="option2" value="1" v-model="asian_checked"> Mostra
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" id="option3" value="0" v-model="asian_checked" checked> Non mostrare
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm col-md-3">
            <div class="card custom_padding no-border my-4 shadow">
                <div class="form-group d-flex flex-column align-items-left w-100">
                    <h3>Mexican Foods</h3>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-primary">
                            <input type="radio" id="option2" value="1" v-model="mexican_checked"> Mostra
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" id="option3" value="0" v-model="mexican_checked" checked> Non mostrare
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm col-md-3">
            <div class="card custom_padding no-border my-4 shadow">
                <div class="form-group d-flex flex-column align-items-left w-100">
                    <h3>Hawaian Foods</h3>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-primary">
                            <input type="radio" id="option2" value="1" v-model="hawaian_checked"> Mostra
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" id="option3" value="0" v-model="hawaian_checked" checked> Non mostrare
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- CHECKBOX FILTER TYPES --}}
    <div>
      <h3>Check your types</h3>
      <div v-for="type in types">
        <input @change="getFilteredRestaurantsByTypes()" type="checkbox" :value="type.id" v-model="checked_types">
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
    {{-- <div class="card custom_padding no-border my-4 shadow">
        <h1 class="search_title">All Restaurants</h1>
        <div  class="row">
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
    </div> --}}

    {{-- <div v-if="pizza_checked == 1" class="card custom_padding no-border my-4 shadow">
        <h1 class="search_title" v-if="pizza_checked == 1">Search for Pizzeria</h1>
        <div class="row">
             <div v-for="pizzeria in array_pizza_checked" class="col-sm col-md-4">
                <div class="card my-4 w-100 h-25">
                    <img v-if="pizzeria.img_path_rest" class="card-img-top g-custom-card-height" :src="'storage/' + pizzeria.img_path_rest" alt="Card image cap">
                    <img v-else class="card-img-top g-custom-card-height" src="" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold"> @{{pizzeria.restaurant_name}}</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <a :href="'restaurant/' + pizzeria.id" class="btn btn-primary">Visualizza ristorante</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-if="italian_checked == 1" class="card custom_padding no-border my-4 shadow">
        <h1 class="search_title" v-if="italian_checked == 1">Search for Italian Foods</h1>
        <div class="row">
            <div v-for="italian in array_italian_checked" class="col-sm col-md-4">
                <div class="card my-4 w-100 h-25">
                    <img v-if="italian.img_path_rest" class="card-img-top g-custom-card-height" :src="'storage/' + italian.img_path_rest" alt="Card image cap">
                    <img v-else class="card-img-top g-custom-card-height" src="" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold"> @{{italian.restaurant_name}}</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <a :href="'restaurant/' + italian.id" class="btn btn-primary">Visualizza ristorante</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-if="sushi_checked == 1" class="card custom_padding no-border my-4 shadow">
        <h1 class="search_title" v-if="sushi_checked == 1">Search for Sushi</h1>
        <div class="row">
            <div v-for="sushi in array_sushi_checked" class="col-sm col-md-4">
                <div class="card my-4 w-100 h-25">
                    <img v-if="sushi.img_path_rest" class="card-img-top g-custom-card-height" :src="'storage/' + sushi.img_path_rest" alt="Card image cap">
                    <img v-else class="card-img-top g-custom-card-height" src="" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold"> @{{sushi.restaurant_name}}</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <a :href="'restaurant/' + sushi.id" class="btn btn-primary">Visualizza ristorante</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-if="vegan_checked == 1" class="card custom_padding no-border my-4 shadow">
        <h1 class="search_title" v-if="vegan_checked == 1">Search for Vegan Foods</h1>
        <div class="row">
            <div v-for="vegan in array_vegan_checked" class="col-sm col-md-4">
                <div class="card my-4 w-100 h-25">
                    <img v-if="vegan.img_path_rest" class="card-img-top g-custom-card-height" :src="'storage/' + vegan.img_path_rest" alt="Card image cap">
                    <img v-else class="card-img-top g-custom-card-height" src="" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold"> @{{vegan.restaurant_name}}</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <a :href="'restaurant/' + vegan.id" class="btn btn-primary">Visualizza ristorante</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-if="organic_checked == 1" class="card custom_padding no-border my-4 shadow">
        <h1 class="search_title" v-if="organic_checked == 1">Search for Organic Foods</h1>
        <div class="row">
            <div v-for="organic in array_organic_checked" class="col-sm col-md-4">
                <div class="card my-4 w-100 h-25">
                    <img v-if="organic.img_path_rest" class="card-img-top g-custom-card-height" :src="'storage/' + organic.img_path_rest" alt="Card image cap">
                    <img v-else class="card-img-top g-custom-card-height" src="" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold"> @{{organic.restaurant_name}}</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <a :href="'restaurant/' + organic.id" class="btn btn-primary">Visualizza ristorante</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-if="street_checked == 1" class="card custom_padding no-border my-4 shadow">
        <h1 class="search_title" v-if="street_checked == 1">Search for Street Foods</h1>
        <div class="row">
            <div v-for="street in array_street_checked" class="col-sm col-md-4">
                <div class="card my-4 w-100 h-25">
                    <img v-if="street.img_path_rest" class="card-img-top g-custom-card-height" :src="'storage/' + street.img_path_rest" alt="Card image cap">
                    <img v-else class="card-img-top g-custom-card-height" src="" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold"> @{{street.restaurant_name}}</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <a :href="'restaurant/' + street.id" class="btn btn-primary">Visualizza ristorante</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-if="asian_checked == 1" class="card custom_padding no-border my-4 shadow">
        <h1 class="search_title" v-if="asian_checked == 1">Search for Asian Foods</h1>
        <div class="row">
            <div v-for="asian in array_asian_checked" class="col-sm col-md-4">
                <div class="card my-4 w-100 h-25">
                    <img v-if="asian.img_path_rest" class="card-img-top g-custom-card-height" :src="'storage/' + asian.img_path_rest" alt="Card image cap">
                    <img v-else class="card-img-top g-custom-card-height" src="" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold"> @{{asian.restaurant_name}}</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <a :href="'restaurant/' + asian.id" class="btn btn-primary">Visualizza ristorante</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-if="mexican_checked == 1" class="card custom_padding no-border my-4 shadow">
        <h1 class="search_title" v-if="mexican_checked == 1">Search for Mexican Foods</h1>
        <div class="row">
            <div v-for="mexican in array_mexican_checked" class="col-sm col-md-4">
                <div class="card my-4 w-100 h-25">
                    <img v-if="mexican.img_path_rest" class="card-img-top g-custom-card-height" :src="'storage/' + mexican.img_path_rest" alt="Card image cap">
                    <img v-else class="card-img-top g-custom-card-height" src="" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold"> @{{mexican.restaurant_name}}</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <a :href="'restaurant/' + mexican.id" class="btn btn-primary">Visualizza ristorante</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-if="hawaian_checked == 1" class="card custom_padding no-border my-4 shadow">
        <h1 class="search_title" v-if="hawaian_checked == 1">Search for Hawaian Foods</h1>
        <div class="row">
            <div v-for="hawaian in array_hawaian_checked" class="col-sm col-md-4">
                <div class="card my-4 w-100 h-25">
                    <img v-if="hawaian.img_path_rest" class="card-img-top g-custom-card-height" :src="'storage/' + hawaian.img_path_rest" alt="Card image cap">
                    <img v-else class="card-img-top g-custom-card-height" src="" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold"> @{{hawaian.restaurant_name}}</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <a :href="'restaurant/' + hawaian.id" class="btn btn-primary">Visualizza ristorante</a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

{{-- @endsection --}} --}}
