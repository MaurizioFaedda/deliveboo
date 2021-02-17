@extends('layouts.dashboard')

@section('content')
    <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12">
                @if ($countRestaurants == 0)
                <div class="card no-border mt-3 border-radius-top">
                    <div class="card-header card-header text-center no-border border-radius-top form-font">Aggiungi il tuo ristorante.</div>
                    <form class="d-flex flex-column align-items-center py-5" action="{{route('admin.restaurants.store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="card border-0 mb-5 w-75">
                      <div class="card-body shadow p-3">
                          <div class="form-group d-flex flex-column w-100">
                            <label class="form-font" for="title">Restaurant Name</label>
                            <input class="form-check form-font" type="text" class="form-control" name="restaurant_name" placeholder="Write your restaurant name here" value="{{old('restaurant_name')}}" required>
                            {{-- SHOWING ERROR MESSAGE --}}
                            @error('restaurant_name')
                                <div class="alert alert-danger">
                                  {{ $message }}
                                </div>
                            @enderror
                          </div>
                          <div class="form-group d-flex flex-column w-100">
                            <label class="form-font" for="title">City</label>
                            <input class="form-check form-font" type="text" class="form-control" name="city" placeholder="City" value="{{old('city')}}" required>
                            {{-- SHOWING ERROR MESSAGE --}}
                            @error('city')
                                <div class="alert alert-danger">
                                  {{ $message }}
                                </div>
                            @enderror
                          </div>
                          <div class="form-group d-flex flex-column w-100">
                            <label class="form-font" for="title">Address</label>
                            <input class="form-check form-font" type="text" class="form-control" name="address" placeholder="Full address" value="{{old('address')}}" required>
                            {{-- SHOWING ERROR MESSAGE --}}
                            @error('address')
                                <div class="alert alert-danger">
                                  {{ $message }}
                                </div>
                            @enderror
                          </div>
                      </div>
                  </div>
                  <div class="card border-0 mb-5 w-75">
                      <div class="card-body shadow p-3">
                          <h2 class="h4 mb-2 py-2 form-font font-weight-bold">Inserisci una foto</h2>
                          <input class="pl-1 form-font" type="file" class="form-control-file" name="image">
                      </div>
                  </div>
                  <div class="card border-0 mb-5 w-75">
                      <div class="card-body shadow p-3">
                          <h2 class="h4 mb-2 py-2 form-font font-weight-bold">Scegli la tipologia del tuo ristorante</h2>
                          @foreach ($types as $type)
                            <div class="form-check form-font">
                              <input type="checkbox" name="types[]" value="{{$type->id}}"
                              {{in_array($type->id, old('types', [])) ? 'checked=checked' : ''}} class="form-check-input cursor-pointer">
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
                  </div>
                  <div class="form-group d-flex justify-content-end">
                    <button type="submit" class="btn btn-success text-uppercase form-font shadow">
                      Submit
                    </button>
                  </div>
                </form>
                </div>
            </div>
          @else
              <div class="row">
                  <div class="col-md-6 mb-3">
                      <div class="card">
                          <div class="card-body">
                              <h5 class="card-title font-weight-bold text-uppercase">Your recent dishes </h5>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6 mb-3">
                      <div class="card">
                          <div class="card-body">
                              <h5 class="card-title font-weight-bold text-uppercase">Your recent orders </h5>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6 mb-3">
                      <div class="card">
                          <div class="card-body">
                              <h5 class="card-title font-weight-bold text-uppercase">Your recent dishes </h5>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6 mb-3">
                      <div class="card">
                          <div class="card-body">
                              <h5 class="card-title font-weight-bold text-uppercase">Your recent orders </h5>
                          </div>
                      </div>
                  </div>

              </div>
          @endif
      </div>
    </div>
@endsection
