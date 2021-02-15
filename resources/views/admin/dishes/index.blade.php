@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card no-border mt-3 border-radius-top">
                    <div class="card-header card-header text-center no-border border-radius-top">
                        Elenco piatti.
                    </div>
                    <ul class="list-group overflow-auto my-2 mx-2 no-border">
                        @foreach ($dishes as $dish)
                            <li class="list-group-item no-border">
                                
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{route('admin.dishes.create')}}" class="btn btn-primary my-3 mx-3">
                        Nuovo piatto.
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
