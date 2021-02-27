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
@endsection
