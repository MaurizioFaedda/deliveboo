@extends('layouts.dashboard')

@section('content')
<div class="container">

    <div class="margin-top row justify-content-center">
            <div class="custom_card card">
                @if ($countRestaurants == 0)
                    Form per inserire il primo ristorante
                @else
                    Hello world
                @endif
                <div class="card-body">
                    <h1 class="custom-title">Benvenuto nella dashboard, inserisci i piatti per cominciare</h1>
                </div>
            </div>
    </div>

</div>
@endsection
