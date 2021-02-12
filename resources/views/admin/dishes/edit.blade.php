@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Modifica il tuo piatto.</div>
                    <form action="index.html" method="post">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Nome piatto" aria-describedby="Inserisci il nome del piatto">
                        </div>
                        <div class="input-group">
                            <textarea class="form-control" placeholder="Inserisci descrizione ed ingredienti del piatto"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Prezzo" aria-describedby="Inserisci il prezzo del piatto">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" aria-label="Checkbox for following text input">
                                    visible
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-dark btn-lg btn-block">Modifica piatto.</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
