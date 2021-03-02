@extends('layouts.guest_home')
@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-12 col-sm-12 p-0">
            <div class="card flex-row justify-content-center align-items-center custom_padding no-border my-4 my-shadow w-100 custom-height_jumbotron custom_background_jumbotron">
                <div class="row justify-content-center align-items-center">
                    <div class="col-sm col-md-6">
                        <h1>I piatti che ami, a domicilio.</h2>
                    </div>
                    <div class="col-sm col-md-6 d-flex flex-row justify-content-center">
                        <img class="img_jumbotron" src="img\homepage.png" alt="">
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="card p-3 w-100 border-0 my-shadow p-2 mb-4">
            <div class="form-check form-check-inline py-2 mr-0 d-flex flex-wrap">
                <div class="col-lg-2 col-md-3 col-sm-12" v-for="(type, index) in types">
                    <div :class="bool_checked[index]" class="card show-button-types w-100 p-1 pb-3 d-flex flex-row align-items-center justify-content-start custom_background_select mb-3">
                        <input @click="getSearched(index)" class="form-check-input" id="inlineCheckbox1" @change="getFilteredRestaurantsByTypes()" type="checkbox" :value="type.id" v-model="checked_types">
                        <label class="form-check-label p-2 font-weight-bold text-dark d-flex flex-column justify-content-center align-items-center" for="type.type">
                            @{{type.type}}
                            <img :src="'img/' + type.img_path_type" alt="">
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card p-3 w-100 border-0 my-shadow d-flex">
            <h3 class="card p-2 border-0 font-weight-bold">Ristoranti selezionati: </h3>
            <button class="show-button p-2 mt-2 no-border font-weight-bold w-50 align-self-center" @click="getAllRestaurants()" type="button" name="button">Show all</button>
            <ul v-if="checked_types.length > 0" class="list-inline mt-3 p-2">
                <li v-for="check in checked_types" class="list-inline-item">
                    <h3 class="card bg-light p-2 border-0 font-weight-bold" v-if="check == 1">Pizzeria</h3>
                    <h3 class="card bg-light p-2 border-0 font-weight-bold" v-if="check == 2">Italian Foods</h3>
                    <h3 class="card bg-light p-2 border-0 font-weight-bold" v-if="check == 3">Sushi</h3>
                    <h3 class="card bg-light p-2 border-0 font-weight-bold" v-if="check == 4">Vegan Foods</h3>
                    <h3 class="card bg-light p-2 border-0 font-weight-bold" v-if="check == 5">Organic Foods</h3>
                    <h3 class="card bg-light p-2 border-0 font-weight-bold" v-if="check == 6">Street Foods</h3>
                    <h3 class="card bg-light p-2 border-0 font-weight-bold" v-if="check == 7">Asian Foods</h3>
                    <h3 class="card bg-light p-2 border-0 font-weight-bold" v-if="check == 8">Mexican</h3>
                    <h3 class="card bg-light p-2 border-0 font-weight-bold" v-if="check == 9">Hawaian Foods</h3>
                </li>
            </ul>
            <ul v-if="checked_types.length == 0" class="list-inline mt-3">
                <li class="list-inline-item">
                    <h3 class="card bg-light p-2 border-0 font-weight-bold">Tutti</h3>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="card custom_padding no-border my-4 pb-5 my-shadow w-100 thiscartbody">
            <div class="text-left">
                <h1 class="search_title text-left pl-0 align-baseline"><span class="icon-rider-main-color"></span>Restaurants delivering in <strong>Rome</strong></h1>
            </div>
            <div class="row">
                 <div v-for="restaurant in restaurants" class="col-lg-3 col-md-4 col-sm-12 card-restaurant mb-5">
                    <div class="card my-4 w-100 h-100 no-border my-shadow p-3 rounded-top">
                        <a class="h-50 img-box" :href="'restaurant/' + restaurant.id">
                            <img v-if="restaurant.img_path_rest" class="card-img-top p-2 img-fluid h-100" :src="'storage/' + restaurant.img_path_rest" alt="Card image cap">
                            <img v-else class="card-img-top p-2 img-fluid h-100" src="" alt="Card image cap">
                        </a>
                        <div class="card-body pl-0 pb-0">
                            <h5 class="card-title font-weight-bold pl-3 m-0 h-25 d-flex align-items-center"><span class="icon-restaurant-main-color"></span> @{{restaurant.restaurant_name}}</h5>
                            <p class="card-text p-infos pl-3 pt-1">
                                @{{restaurant.description}}
                            </p>
                            <a :href="'restaurant/' + restaurant.id" class="btn my-button-success m-1 ml-3">Show more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
