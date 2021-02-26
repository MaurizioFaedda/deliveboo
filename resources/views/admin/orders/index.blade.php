@extends('layouts.dashboard')

{{-- titolo --}}
@section("page-title", "Deliveboo | Your Orders")

@section('content')
    <div class="container">
        <div class="row justify-content-left">
            @foreach ($restaurants as $restaurant)
                <div class="col-md-6">
                    <div class="card my-4 shadow">
                        <h4>
                            Restaurant: {{ $restaurant->restaurant_name}}
                        </h4>
                        <table class="table text-center mb-0 bg-white">
                            <thead>
                                <tr class="text-left">
                                    <th class="text-left">Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Date order</th>
                                    <th>Total price</th>
                                </tr>
                            </thead>
                        </table>
                        <div class="card rounded-0 no-border shadow overflow-auto">
                            <table class="table text-center mb-0">
                                <tbody>
                                    @foreach ($orders as $order)
                                        @if ($order->restaurant_id == $restaurant->id )
                                            <tr class="text-left">
                                                <td>
                                                    {{ $order->first_name}}
                                                </td>
                                                <td>
                                                    {{ $order->lastname}}
                                                </td>
                                                <td>
                                                    {{ $order->email}}
                                                </td>
                                                <td>
                                                    {{\Carbon\Carbon::parse($order->delivery_time)->format('j F, Y')}}
                                                </td>
                                                <td>
                                                    {{number_Format($order->total_price, 2, ',', '')}} €
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <canvas id="myChart1"></canvas>
    <script type="text/javascript">
        var ctx = document.getElementById('myChart1').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'pie',
            // The data for our dataset
            data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: 'My First dataset',
                backgroundColor: 'lightblue',
                borderColor: 'rgb(255, 99, 132)',
                data: [<?php
                    foreach ($orders_count_date as $count) {
                        echo $count. ',';
                    };
                ?>]
            }]
        },
        // Configuration options go here
        options: {}
        });
    </script>
@endsection
