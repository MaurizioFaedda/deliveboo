@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Benvenuto!') }}
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center my-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <button type="button" class="btn btn-dark btn-lg btn-block">Inserisci nuovi piatti.</button>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between">
                            <p>Item</p>
                            <div>
                                <button type="button" class="btn btn-secondary">Modifica</button>
                                <button type="button" class="btn btn-secondary">Cancella</button>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <p>Item</p>
                            <div>
                                <button type="button" class="btn btn-secondary">Modifica</button>
                                <button type="button" class="btn btn-secondary">Cancella</button>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <p>Item</p>
                            <div>
                                <button type="button" class="btn btn-secondary">Modifica</button>
                                <button type="button" class="btn btn-secondary">Cancella</button>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <p>Item</p>
                            <div>
                                <button type="button" class="btn btn-secondary">Modifica</button>
                                <button type="button" class="btn btn-secondary">Cancella</button>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <p>Item</p>
                            <div>
                                <button type="button" class="btn btn-secondary">Modifica</button>
                                <button type="button" class="btn btn-secondary">Cancella</button>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
