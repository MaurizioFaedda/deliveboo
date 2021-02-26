<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield("page-title", "Deliveboo | Homepage")</title>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">

    <!-- Favicon -->
        <link rel="icon" href="{{ asset('img/favicon.png') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <div class="logo-navbar d-flex align-items-center">
                        <a href="{{ url('/') }}">
                            <img src="{{asset('img/deliveroo-logo.png')}}" alt="">
                        </a>
                    </div>
                    {{-- <div class="search-box w-50 mx-auto my-2">
                        <button type="button" name="button"></button>
                        <input placeholder="Piatti,ristoranti o tipi di cucina" type="text" ref="search">
                    </div> --}}
                    <div class="">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>


                        <div class="collapse navbar-collapse nav-top-right" id="navbarSupportedContent">
                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auto">
                                <!-- Authentication Links -->
                                @guest
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-bold" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link font-weight-bold" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('admin.index') }}">
                                                My Dashboard
                                            </a>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                            </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>

                        </div>
                    </div>

                </div>
            </div>
        </nav>

        <div class="container-fluid mt-5">
            <div class="row mx-4">
                {{-- <nav id="guest-sidebar" class="col-lg-2 col-md-3 d-none d-md-block p-2 overflow-auto"> --}}
                    <div class="sidebar-sticky d-flex flex-column">
                        <div class="filter d-flex flex-column justify-content-center w-100 mb-2">
                          {{-- <select @change="getFilteredRestaurants()" v-model="selected_type" id="type-filter" class="p-2">
                              <option value="">All types</option>
                              <option v-for="type in types" :value="type.id">
                                @{{type.type}}
                              </option>
                          </select> --}}
                          
                        </div>
                        {{-- <div class="form-check form-check-inline py-2 mr-0" v-for="type in types">
                            <div class="card show-button w-100 p-1 d-flex flex-row align-items-center justify-content-start custom_background_select">
                                <input class="form-check-input" id="inlineCheckbox1" @change="getFilteredRestaurantsByTypes()" type="checkbox" :value="type.id" v-model="checked_types">
                                <label class="form-check-label p-2 font-weight-bold text-dark" for="type.type">
                                    <img :src="'img/' + type.img_path_type" alt="">
                                </label>
                            </div>
                        </div> --}}
                    </div>
                </nav>
                <main class="col-lg-12 col-md-12 ml-sm-auto px-0 mt-3">
                    @yield('content')
                </main>
          </div>
          <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                  <!-- Footer -->
                  <footer class="text-center text-lg-start w-100 font-weight-bold shadow">
                      <!-- Grid container -->
                      <div class="container p-4">
                          <!--Grid row-->
                          <div class="row">
                              <!--Grid column-->
                              <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                                  <h5 class="text-uppercase font-weight-bold">Footer Content</h5>

                                  <p class="footer_paragraph">
                                      Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iste atque ea quis
                                      molestias. Fugiat pariatur maxime quis culpa corporis vitae repudiandae aliquam
                                      voluptatem veniam, est atque cumque eum delectus sint!
                                  </p>
                              </div>
                              <!--Grid column-->

                              <!--Grid column-->
                              <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                                  <h5 class="text-uppercase font-weight-bold">LinkedIn - Links</h5>

                                  <ul class="list-unstyled mb-0">
                                      <li>
                                          <a href="https://www.linkedin.com/in/marco-caputo-58000a1ab/" class="text-dark">Marco Caputo</a>
                                      </li>
                                      <li>
                                          <a href="https://www.linkedin.com/in/maurizio-faedda/" class="text-dark">Maurizio Faedda</a>
                                      </li>
                                      <li>
                                          <a href="https://www.linkedin.com/in/patriziacrimi/" class="text-dark">Patrizia Crimi</a>
                                      </li>
                                  </ul>
                              </div>
                              <!--Grid column-->

                              <!--Grid column-->
                              <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                                  <h5 class="text-uppercase font-weight-bold">LinkedIn - Links</h5>

                                  <ul class="list-unstyled">
                                      <li>
                                          <a href="https://www.linkedin.com/in/annalisa-de-santis-354a7b205/" class="text-dark">Annalisa De Santis</a>
                                      </li>
                                      <li>
                                          <a href="https://www.linkedin.com/in/sabrinacunsolo/" class="text-dark">Sabrina Cunsolo</a>
                                      </li>
                                  </ul>
                              </div>
                              <!--Grid column-->
                          </div>
                          <!--Grid row-->
                      </div>
                      <!-- Grid container -->

                      <!-- Copyright -->
                      <!-- Copyright -->
                  </footer>
                  <!-- Footer -->

              </div>
          </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('cart-js')
</body>
</html>
