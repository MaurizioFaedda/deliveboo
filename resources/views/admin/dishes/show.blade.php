@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="margin-top row justify-content-center">
                <div class="custom_card card">
                    <div class="card-body">
                        <h1 class="custom-title">
                            Benvenuto nella dashboard, inserisci i piatti per cominciare
                        </h1>
                    </div>
                </div>

            <div class="col-md-12">
                <div class="card no-border mt-3">
                    <div class="card-header text-center no-border border-radius-top">
                        <button type="button" class="btn btn-lg btn-block border-radius-top no-border">Inserisci nuovi piatti.</button>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <ul class="list-group custom-list overflow-auto">
                            <li class="list-group-item d-flex justify-content-between no-border">
                                <p>Item</p>
                                <div>
                                    <button type="button" class="btn btn-success">Modifica</button>
                                    <button type="button" class="btn btn-danger">Cancella</button>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between no-border">
                                <p>Item</p>
                                <div>
                                    <button type="button" class="btn btn-success">Modifica</button>
                                    <button type="button" class="btn btn-danger">Cancella</button>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between no-border">
                                <p>Item</p>
                                <div>
                                    <button type="button" class="btn btn-success">Modifica</button>
                                    <button type="button" class="btn btn-danger">Cancella</button>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between no-border">
                                <p>Item</p>
                                <div>
                                    <button type="button" class="btn btn-success">Modifica</button>
                                    <button type="button" class="btn btn-danger">Cancella</button>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between no-border">
                                <p>Item</p>
                                <div>
                                    <button type="button" class="btn btn-success">Modifica</button>
                                    <button type="button" class="btn btn-danger">Cancella</button>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between no-border">
                                <p>Item</p>
                                <div>
                                    <button type="button" class="btn btn-success">Modifica</button>
                                    <button type="button" class="btn btn-danger">Cancella</button>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between no-border">
                                <p>Item</p>
                                <div>
                                    <button type="button" class="btn btn-success">Modifica</button>
                                    <button type="button" class="btn btn-danger">Cancella</button>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between no-border">
                                <p>Item</p>
                                <div>
                                    <button type="button" class="btn btn-success">Modifica</button>
                                    <button type="button" class="btn btn-danger">Cancella</button>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between no-border">
                                <p>Item</p>
                                <div>
                                    <button type="button" class="btn btn-success">Modifica</button>
                                    <button type="button" class="btn btn-danger">Cancella</button>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between no-border">
                                <p>Item</p>
                                <div>
                                    <button type="button" class="btn btn-success">Modifica</button>
                                    <button type="button" class="btn btn-danger">Cancella</button>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between no-border">
                                <p>Item</p>
                                <div>
                                    <button type="button" class="btn btn-success">Modifica</button>
                                    <button type="button" class="btn btn-danger">Cancella</button>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between no-border">
                                <p>Item</p>
                                <div>
                                    <button type="button" class="btn btn-success">Modifica</button>
                                    <button type="button" class="btn btn-danger">Cancella</button>
                                </div>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
