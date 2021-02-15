@extends('layouts.dashboard')

@section('content')
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-md-8">
                    @if ($countRestaurants == 0)
                  <div class="card no-border border-radius-top mt-3">
                    <div class="card-header card-header text-center no-border border-radius-top">Aggiungi il tuo ristorante.</div>
                    <form class="d-flex flex-column align-items-center py-3" action="{{route('admin.restaurants.store')}}" method="post">
                      @csrf
                      <div class="form-group d-flex flex-column align-items-center w-50">
                        <label for="title">Restaurant Name</label>
                        <input type="text" class="form-control" name="restaurant_name" placeholder="Write your restaurant name here" value="{{old('restaurant_name')}}" required>
                        {{-- SHOWING ERROR MESSAGE --}}
                        @error('restaurant_name')
                            <div class="alert alert-danger">
                              {{ $message }}
                            </div>
                        @enderror
                      </div>
                      <div class="form-group d-flex flex-column align-items-center w-50">
                        <label for="title">City</label>
                        <input type="text" class="form-control" name="city" placeholder="City" value="{{old('city')}}" required>
                        {{-- SHOWING ERROR MESSAGE --}}
                        @error('city')
                            <div class="alert alert-danger">
                              {{ $message }}
                            </div>
                        @enderror
                      </div>
                      <div class="form-group d-flex flex-column align-items-center w-50">
                        <label for="title">Address</label>
                        <input type="text" class="form-control" name="address" placeholder="Full address" value="{{old('address')}}" required>
                        {{-- SHOWING ERROR MESSAGE --}}
                        @error('address')
                            <div class="alert alert-danger">
                              {{ $message }}
                            </div>
                        @enderror
                      </div>
                      <div class="form-group d-flex flex-column align-items-left w-50">
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
              @else
                  Hello world
                  <div class="card-body">
                      <h1 class="custom-title">Benvenuto nella dashboard, inserisci i piatti per cominciare</h1>
                  </div>
              @endif
                </div>
              </div>
            </div>
@endsection
