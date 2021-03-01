@extends('layouts.dashboard')

{{-- titolo --}}
@section("page-title", "Deliveboo | Your Dashboard")

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if ($countRestaurants == 0)
                    <div class="card no-border mt-3 border-radius-top">
                        <div class="card-header card-header text-center no-border border-radius-top form-font">
                            Create your restaurant
                        </div>
                        <form class="d-flex flex-column align-items-center py-5" action="{{route('admin.restaurants.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card border-0 mb-5 w-75">
                                <div class="card-body shadow p-3">
                                    <div class="form-group d-flex flex-column w-100">
                                        <label class="form-font" for="title">Restaurant Name</label>
                                        <input class="form-check form-font" type="text" class="form-control" name="restaurant_name" placeholder="Write your restaurant name here" value="{{old('restaurant_name')}}" required>
                                        {{-- SHOWING ERROR MESSAGE --}}
                                        @error('restaurant_name')
                                            <div class="alert alert-danger">
                                              {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group d-flex flex-column w-100">
                                        <label class="form-font" for="title">City</label>
                                        <input class="form-check form-font" type="text" class="form-control" name="city" placeholder="City" value="{{old('city')}}" required>
                                        {{-- SHOWING ERROR MESSAGE --}}
                                        @error('city')
                                            <div class="alert alert-danger">
                                              {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group d-flex flex-column w-100">
                                        <label class="form-font" for="title">Address</label>
                                        <input class="form-check form-font" type="text" class="form-control" name="address" placeholder="Full address" value="{{old('address')}}" required>
                                        {{-- SHOWING ERROR MESSAGE --}}
                                        @error('address')
                                            <div class="alert alert-danger">
                                              {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card border-0 mb-5 w-75">
                                <div class="card-body shadow p-3">
                                    <h2 class="h4 mb-2 py-2 form-font font-weight-bold">Insert a picture of your restaurant</h2>
                                    <input class="pl-1 form-font" type="file" class="form-control-file" name="image">
                                </div>
                            </div>
                            <div class="card border-0 mb-5 w-75">
                                <div class="card-body shadow p-3">
                                    <h2 class="h4 mb-2 py-2 form-font font-weight-bold">
                                      Select a type of your restaurant
                                    </h2>
                                    @foreach ($types as $type)
                                    <div class="form-check form-font">
                                        <input type="checkbox" name="types[]" value="{{$type->id}}"
                                        {{in_array($type->id, old('types', [])) ? 'checked=checked' : ''}} class="form-check-input cursor-pointer">
                                        <label class="form-check-label">
                                        {{$type->type}}
                                        </label>
                                    </div>
                                    @endforeach
                                    {{-- SHOWING ERROR MESSAGE --}}
                                    @error('types')
                                      <div class="alert alert-danger">
                                        {{ $message }}
                                      </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group d-flex justify-content-end">
                                <button type="submit" class="btn btn-success text-uppercase form-font shadow">
                                  Submit
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm mb-3">
                            <div class="card border-0 my-shadow">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold text-uppercase">
                                        Your personal details
                                    </h5>
                                    <p>
                                        Name: {{ Auth::user()->name }}
                                    </p>
                                    <p>
                                        Lastname: {{ Auth::user()->lastname }}
                                    </p>
                                    <p>
                                        Vat_number/P.IVA: {{ Auth::user()->vat_number }}
                                    </p>
                                    <p>
                                        Email: {{ Auth::user()->email }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm">
                            <div class="card border-0 my-shadow">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold text-uppercase">
                                        Statistical graphic of your orders
                                    </h5>
                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [<?php
                    foreach ($mounths as $mounth) {
                        echo '"' . $mounth .'"' . ',';
                    };
                ?>],
                datasets: [{
                    label: 'Your orders',
                    data: [<?php
                        foreach ($orders_count_date as $count) {
                            echo $count. ',';
                        };
                    ?>],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            steps: 1,
                            stepValue: 1,
                            max: 10
                        }
                    }]
                }
            }
        });
    </script>
@endsection
