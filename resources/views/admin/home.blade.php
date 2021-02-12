@extends('layouts.dashboard')

@section('content')
<div class="container">

    <div class="margin-top row justify-content-center">
            <div class="custom_card card">
                <div class="card-body">
                    <h1 class="custom-title">Benvenuto nella dashboard, inserisci i piatti per cominciare</h1>
                </div>
            </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <button type="button" class="btn btn-lg btn-block">Inserisci nuovi piatti.</button>
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
