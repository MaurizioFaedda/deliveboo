@extends('layouts.guest_home')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12 col-sm-12 p-0">
            <div class="card flex-row justify-content-center align-items-center custom_padding no-border my-4 shadow w-100 custom_background_jumbotron custom-height_jumbotron">
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
        <div class="card custom_padding no-border my-4 shadow w-100 thiscartbody">
            <div class="text-left">
                <h1 class="search_title text-left pl-0 align-baseline"><span class="icon-rider-main-color"></span>Restaurants delivering in <strong>Rome</strong></h1>
                <h3>Ristoranti selezionati: </h3>
                <ul v-if="checked_types.length > 0" class="list-group">
                    <li v-for="check in checked_types" class="list-group-item">
                        <h3 v-if="check == 1">Pizzeria</h3>
                        <h3 v-if="check == 2">Italian Foods</h3>
                        <h3 v-if="check == 3">Sushi</h3>
                        <h3 v-if="check == 4">Vegan Foods</h3>
                        <h3 v-if="check == 5">Organic Foods</h3>
                        <h3 v-if="check == 6">Street Foods</h3>
                        <h3 v-if="check == 7">Asian Foods</h3>
                        <h3 v-if="check == 8">Mexican</h3>
                        <h3 v-if="check == 9">Hawaian Foods</h3>
                    </li>
                </ul>
                <ul v-if="checked_types.length == 0" class="list-group">
                    <li class="list-group-item">Nessuno</li>
                </ul>
            </div>
            <div  class="row">
                 <div v-for="restaurant in restaurants" class="col-sm col-md-4 card-restaurant my-3">
                    <div class="card my-4 w-100 no-border">
                        <a :href="'restaurant/' + restaurant.id">
                            <img v-if="restaurant.img_path_rest" class="card-img-top g-custom-card-height w-100" :src="'storage/' + restaurant.img_path_rest" alt="Card image cap">
                            <img v-else class="card-img-top g-custom-card-height" src="" alt="Card image cap">
                        </a>
                        <div class="card-body pl-0 pb-0">
                            <h5 class="card-title font-weight-bold"><span class="ml-1 icon-restaurant-main-color"></span> @{{restaurant.restaurant_name}}</h5>
                            <p class="card-text p-infos">
                                @{{restaurant.description}}
                            </p>
                            <a :href="'restaurant/' + restaurant.id" class="btn btn-primary">Show more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
