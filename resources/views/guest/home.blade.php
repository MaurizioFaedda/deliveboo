@extends('layouts.guest_home')
@section('content')
<div class="container">

    <div class="row">
        <div class="card custom_padding no-border my-4 shadow w-100 thiscartbody">
            <div class="text-left">
                <h1 class="search_title text-left pl-0 align-baseline"><span class="icon-rider-main-color"></span>Restaurants delivering in <strong>Rome</strong></h1>
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
@endsection
