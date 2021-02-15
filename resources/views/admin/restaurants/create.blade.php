@extends('layouts.dashboard')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Aggiungi il tuo ristorante.</div>
          <form action="{{route('admin.restaurants.store')}}" method="post">
            @csrf
            <div class="form-group">
              <label for="title">Restaurant Name</label>
              <input type="text" class="form-control" name="restaurant_name" placeholder="Write your restaurant name here" value="{{old('restaurant_name')}}" required>
              {{-- SHOWING ERROR MESSAGE --}}
              @error('restaurant_name')
                  <div class="alert alert-danger">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="title">City</label>
              <input type="text" class="form-control" name="city" placeholder="City" value="{{old('city')}}" required>
              {{-- SHOWING ERROR MESSAGE --}}
              @error('city')
                  <div class="alert alert-danger">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="title">Address</label>
              <input type="text" class="form-control" name="address" placeholder="Full address" value="{{old('address')}}" required>
              {{-- SHOWING ERROR MESSAGE --}}
              @error('address')
                  <div class="alert alert-danger">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="form-group">
              <p>Select types:</p>
              @foreach ($types as $type)
                <div class="form-check">
                  <input type="checkbox" name="types[]" value="{{$type->id}}"
                  {{in_array($type->id, old('types', [])) ? 'checked=checked' : ''}} class="form-check-input">
                  <label class="form-check-label">
                    {{$type->type}}
                  </label>
                </div>
              @endforeach
              {{-- SHOWING ERROR MESSAGE --}}
              @error('types')
                  <div class="alert alert-danger">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="form-group d-flex justify-content-end">
              <button type="submit" class="btn btn-success text-uppercase">
                Submit
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
