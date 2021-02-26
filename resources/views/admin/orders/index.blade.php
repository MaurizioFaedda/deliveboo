@extends('layouts.dashboard')

{{-- titolo --}}
@section("page-title", "Deliveboo | Your Orders")

@section('content')
    <div class="container">
        @foreach ($restaurants as $restaurant)
            <h1>
                {{ $restaurant->restaurant_name}}
                <ul>
                    @foreach ($orders as $order)
                        @if ($order->restaurant_id == $restaurant->id )
                            <li>
                                {{ $order->email}}
                            </li>
                        @endif
                    @endforeach
                </ul>
            </h1>
        @endforeach
    </div>
@endsection
