@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Modifica il tuo piatto.</div>
                    <form action="index.html" method="post">
                        <input class="form-control form-control-lg" type="text" placeholder="Nome Piatto">
                        <input class="form-control form-control-lg" type="text" placeholder="Ingredienti">
                        <input class="form-control form-control-lg" type="text" placeholder="Prezzo">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            Visibile
                        </label>
                        <button type="button" class="btn btn-primary">Modifica</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
