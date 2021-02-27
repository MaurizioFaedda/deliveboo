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
    <canvas id="myChart"></canvas>
    <script type="text/javascript">
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [<?php
                    foreach ($mounths as $mounth) {
                        echo '"' . $mounth .'"' . ',';
                    };
                ?>],
                datasets: [{
                    label: '# of Votes',
                    data: [<?php
                        foreach ($orders_count_date as $count) {
                            echo $count. ',';
                        };
                    ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection
