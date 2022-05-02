@extends('layouts.dashboard')

<!-- Scripts Vue-->
@section('script')
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection

{{-- titolo --}}
@section("page-title", "Deliveboo | Create your Restaurant")

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card no-border mt-3 border-radius-top shadow">
          <div class="text-uppercase card-header card-header text-center no-border border-radius-top nunito">Add new restaurant</div>
          <form class="d-flex flex-column align-items-center py-5" action="{{route('admin.restaurants.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card border-0 mb-5 w-75">
                <div class="card-body shadow p-3">
                    <div class="form-group d-flex flex-column w-100">
                        <label class="nunito" for="title">Restaurant Name</label>
                        <input class="form-check nunito" type="text" class="form-control" name="restaurant_name" placeholder="Write your restaurant name here" value="{{old('restaurant_name')}}" required maxlength="100">
                        {{-- SHOWING ERROR MESSAGE --}}
                        @error('restaurant_name')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group d-flex flex-column w-100">
                        <label class="nunito" for="title">City</label>
                        <input readonly class="form-check nunito bg-light" type="text" class="form-control" name="city" placeholder="Rome" value="Rome" required maxlength="20">
                        {{-- SHOWING ERROR MESSAGE --}}
                        @error('city')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group d-flex flex-column w-100">
                        <label class="nunito" for="title">Address</label>
                        <input class="form-check nunito" type="text" class="form-control" name="address" placeholder="Full address" value="{{old('address')}}" required maxlength="50">
                        {{-- SHOWING ERROR MESSAGE --}}
                        @error('address')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group d-flex flex-column w-100">
                        <label class="nunito" for="title">Description</label>
                        <textarea name="description" rows="8" cols="80">{{ old('description')}}</textarea>
                        {{-- SHOWING ERROR MESSAGE --}}
                        @error('description')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card border-0 mb-5 w-75">
                <div class="card-body shadow p-3">
                    <h2 class="h4 mb-2 py-2 nunito font-weight-bold">Select your restaurant types</h2>
                    @foreach ($types as $type)
                        <div class="form-check  form-font">
                            <input type="checkbox" name="types[]" value="{{$type->id}}"
                            {{in_array($type->id, old('types', [])) ? 'checked=checked' : ''}} class="form-check-input cursor-pointer">
                            <label class="form-check-label nunito">
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
            <div class="card border-0 mb-5 w-75">
                <div class="card-body shadow p-3">
                    <div class="form-group d-flex flex-column align-items-left w-75">
                        <h2 class="h4 mb-2 py-2 nunito font-weight-bold">Upload a picture</h2>
                        <input class="pl-1 form-font" type="file" class="form-control-file nunito" name="image" accept="image/*">
                    </div>
                </div>
            </div>

            <div class="form-group d-flex justify-content-end">
                <button @click="alertNewRestaurant()" type="submit" class="btn btn-success text-uppercase nunito shadow">
                    Submit
                </button>
            </div>
          </form>
        </div>
      </div>
    </div>
@endsection
