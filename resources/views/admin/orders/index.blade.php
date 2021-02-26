@extends('layouts.dashboard')

{{-- titolo --}}
@section("page-title", "Deliveboo | Your Orders")

@section('content')
    <div class="container">
        @foreach ($restaurants as $restaurant)
            <h6>
                {{ $restaurant->restaurant_name}}
                <ul>
                    @foreach ($orders as $order)
                        @if ($order->restaurant_id == $restaurant->id )
                            <li>
                                First Name: {{ $order->first_name}}
                            </li>
                            <li>
                                Last Name: {{ $order->lastname}}
                            </li>
                            <li>
                                Email: {{ $order->email}}
                            </li>
                            <li>
                                Total price: {{ $order->total_price}}
                            </li>
                        @endif
                    @endforeach
                </ul>
            </h6>
        @endforeach
    </div>
    <canvas id="myChart1"></canvas>
    <script type="text/javascript">
        var ctx = document.getElementById('myChart1').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',
            // The data for our dataset
            data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: 'My First dataset',
                backgroundColor: 'lightblue',
                borderColor: 'rgb(255, 99, 132)',
                data: [<?php
                    foreach ($count as $valore) {
                        echo $valore. ',';
                    };
                ?>]
            }]
        },
        // Configuration options go here
        options: {}
        });
    </script>
@endsection
