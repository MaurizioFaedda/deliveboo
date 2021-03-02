@extends('layouts.guest')

{{-- titolo --}}
@section("page-title", "Deliveboo | Transaction Outcome")

@section('content')
    <div class="container vh-100 mt-5">
        {{-- SUCCESSO TRANSAZIONE --> stampo SUCCESS MESSAGE per l'aggiunta dell'ordine e dell'avvvenuto pagamento --}}
        @if (session()->has('success_message'))
            <div class="alert alert-success text-center">
                {{ session()->get('success_message') }}
            </div>
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
        {{-- FALLIMENTO TRANSAZIONE --> stampo ERROR MESSAGE per mancata aggiunta dell'ordine e del pagamento --}}
        @elseif (session()->has('error_message'))
            <div class="alert alert-danger">
                {{ session()->get('error_message') }}
            </div>
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
                  Sorry, the transaction did not succeed.
                </h4>
              </div>
            </div>
            <div class="text-center my-5">
              <a class="text-decoration-none" href="{{route('index')}}">Back To Home</a>
            </div>
        @endif
    </div>
@endsection
