@extends('layouts.dashboard')

@section('content')
    <div class="container">
        @foreach ($dishes as $dish)
            <p>
                {{ $dish->name}}
            </p>
        @endforeach
    </div>
@endsection
