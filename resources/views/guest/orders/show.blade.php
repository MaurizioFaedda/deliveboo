@extends('layouts.guest')

{{-- titolo --}}
@section("page-title", "Deliveboo | Restaurant")

@section('content')
    <div class="container vh-100 mt-5">
        {{-- SUCCESS MESSAGE per l'aggiunta dell'ordine --}}
        @if (session()->has('success_message'))
            <div class="alert alert-success text-center">
                {{ session()->get('success_message') }}
            </div>
        @endif
        {{-- ERROR MESSAGE per l'aggiunta dell'ordine --}}
        @if (session()->has('error_message'))
            <div class="alert alert-danger">
                {{ session()->get('error_message') }}
            </div>
        @endif
        <div class="card-order-success">
            <div class="success-checkmark">
                <div class="check-icon">
                    <span class="icon-line line-tip"></span>
                    <span class="icon-line line-long"></span>
                    <div class="icon-circle"></div>
                    <div class="icon-fix"></div>
                </div>
            </div>
            <div class="text-center">
                <h4>
                    Congratulations, the payment was a success.
                    <br>
                    All order details will be sent to the email indicated
                </h4>
            </div>
        </div>
        <div class="text-center my-5">
            <a class="text-decoration-none" href="{{route('index')}}">Back To Home</a>
        </div>
    </div>
@endsection
