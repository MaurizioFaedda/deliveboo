@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="card">
            <p>
                {{ $dish->name}}
            </p>
            <p>
                {{ $dish->infos}}
            </p>
            <p>
                {{ $dish->price}}
            </p>
            <p>
                {{ $dish->visibile}}
            </p>
        </div>
    </div>
@endsection
