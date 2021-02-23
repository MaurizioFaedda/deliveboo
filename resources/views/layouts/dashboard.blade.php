<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="background-color: #C9FAFF">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield("page-title", "Deliveboo | Dashboard")</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">

    <!-- Favicon -->
        <link rel="icon" href="{{ asset('img/favicon.png') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body style="background-color: #C9FAFF">
    <div id="app">
        <nav class="navbar fixed-top nav-color navbar-expand-md text-white shadow-sm">
            <div class="container-fluid p-0">
                <a class="navbar-brand text-white m-0" href="{{ url('/') }}">
                    Deliveboo
                </a>
                <ul id="my-icon-menu" class="">
                    <li>
                        <a href="{{ route('admin.index') }}"> <span class="icon-responsive icon-dashboard"></span> </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.restaurants.index') }}"> <span class="icon-responsive icon-restaurant"></span> </a>
                    </li>
                    <li>
                        <a href="#"> <span class="icon-responsive icon-order"></span> </a>
                    </li>
                </ul>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span id="icon-burger" class="navbar-toggler-icon d-flex align-items-center"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Welcome {{ Auth::user()->name }}
                                <span id="icon-user"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a id="log-main-color" class="dropdown-item text-main-color" href="{{ route('logout') }}"
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
        </nav>

        <!-- Sidebar -->
        <div class="container-fluid">
            <div class="row">
                <nav id="my-sidebar" class="nav-color col-md-2 col-sm-2 d-none d-md-block">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('admin.index') }}"><span class="my-icon icon-dashboard"></span>Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('admin.restaurants.index') }}"><span class="my-icon icon-restaurant"></span>Restaurants </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('admin.index') }}"><span class="my-icon icon-order"></span>Orders </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <main class="col-md-10 ml-md-auto mx-sm-0 mt-5 pt-5">
                    @yield('content')
                </main>
          </div>
      </div>
  </div>
</body>
</html>
