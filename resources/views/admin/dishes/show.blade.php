@extends('layouts.dashboard')

<!-- Scripts Vue-->
@section('script')
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection

{{-- titolo --}}
@section("page-title", "Deliveboo | Dish")

@section('content')
    <div class="container">
        <div class="card px-3 py-4">
            <div class="d-flex justify-content-between">
                <button class="back-link btn btn-link w-25 text-left pl-0" type="button" name="button">
                    <a href="{{ route('admin.restaurants.show', ['restaurant' => $restaurant]) }}">
                        <span class="icon-back"></span>
                        <span class="text-uppercase font-weight-bold">
                            Back
                        </span>
                    </a>
                </button>
                <div class="text-right">
                    <a class="text-decoration-none" href="{{ route('admin.dishes.edit', ['dish'=> $dish->id]) }}">
                        <span class="icon-edit"></span>
                    </a>
                    <form class="d-inline-block" action="{{ route('admin.dishes.destroy', ['dish' => $dish->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button @click="alertDeleteDish()" class="btn btn-link delete-restaurant align-baseline" type="submit">
                            <span class="icon-delete "></span>
                        </button>
                    </form>
                </div>
            </div>
            <div class="text-center">

            </div>
            <div class="row d-flex">
                <div class="col-md-4">
                    <div class="d-flex flex-column justify-content-between h-75">
                        <div class="">
                            <small><strong>Dish</strong></small>
                            <h4>{{ $dish->name}}</h4>
                        </div>
                        <div class="">
                            <small><strong>Ingredients/Desription</strong></small>
                            <p>{{ $dish->infos}}</p>
                        </div>
                        <div class="">
                            <small><strong>Price</strong></small>
                            <p> €
                                <strong>
                                    {{number_Format($dish->price, 2, ',', '')}}
                                </strong>
                            </p>
                        </div>
                        <div class="">
                            <small><strong>Availability</strong></small>
                            <p>
                            Your dish is currently <strong>{{$dish->visible ? "" : "not"}} visible</strong> in the menu.
                            </p>
                        </div>
                    </div>
                    <div class="">

                    </div>
                </div>
                <div class="col-md-8 text-right">
                    <div class="img-dish-show w-100">
                        @if($dish->img_path_dish)
                            <img class="w-100" src="{{ asset('storage/' . $dish->img_path_dish)}}" alt="{{ $dish->name}}">
                        @else
                            <img class="w-100" src="{{ asset('img/img_not_available_dish.png')}}" alt="{{ $dish->name}} not available">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
