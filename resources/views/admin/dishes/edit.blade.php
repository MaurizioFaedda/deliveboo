@extends('layouts.dashboard')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card no-border mt-3">
                <div class="card-header card-header text-center no-border border-radius-top">
                    Modifica il tuo piatto
                </div>
                <form class="d-flex flex-column align-items-center py-3" action="{{ route('admin.dishes.update', ['dish' => $dish->id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group d-flex flex-column align-items-center w-50">
                      <label for="title">Dish Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Write your dish name here" value="{{ old('name', $dish->name) }}" required>
                      {{-- SHOWING ERROR MESSAGE --}}
                      @error('name')
                          <div class="alert alert-danger">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group d-flex flex-column align-items-center w-50">
                      <label for="title">Infos</label>
                      <textarea name="infos" rows="8" cols="80">{{ old('infos', $dish->infos)}}</textarea>
                      {{-- SHOWING ERROR MESSAGE --}}
                      @error('infos')
                          <div class="alert alert-danger">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="visible" value="1" {{ $dish->visible == 1 ? 'checked=checked' : ''}}>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Available
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="visible" value="0" {{ $dish->visible == 0 ? 'checked=checked' : ''}}>
                        <label class="form-check-label" for="flexRadioDefault2">
                          Not Available
                        </label>
                    </div>
                    <div class="form-group d-flex flex-column align-items-center w-50">
                      <label for="title">Price</label>
                      <input type="number" class="form-control" name="price" placeholder="price" value="{{old('price', $dish->price)}}" required step="0.01">
                      {{-- SHOWING ERROR MESSAGE --}}
                      @error('price')
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
