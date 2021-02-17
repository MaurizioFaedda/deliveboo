@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            {{--              FORM PER CREAZIONE PIATTO             --}}
            <div class="col-md-4 col-sm-12">
             <div class="card no-border border-radius-top shadow p-4">
                @if($restaurant->img_path_rest)
                    <div class="img-wrapper">
                        <img class="img-fluid" src="{{ asset('storage/' . $restaurant->img_path_rest)}}" alt="{{$restaurant->restaurant_name}}">
                    </div>
                @else
                    <img src="{{ asset('img/img_not_available.png')}}" alt="not img">
                @endif
            </div>
            <div>
                @forelse ($restaurant->types as $type)
                    {{ $type->type }}
                @empty
                    <p>Non sono state inserite tipologie</p>
                @endforelse
            </div>
              <div class="card no-border border-radius-top mt-3 shadow">
                <div class="card-header card-header text-center no-border border-radius-top p-3">
                    <h5 class="mb-0">Aggiungi un nuovo piatto</h5>
                </div>
                <form class="d-flex flex-column align-items-left py-3 px-3" action="{{route('admin.dishes.store')}}" method="post">
                  @csrf
                  <div class="form-group d-none">
                      <input type="text" class="form-control" name="restaurant_id" value="{{$restaurant->id}}" required>
                  </div>
                  <div class="form-group d-flex flex-column align-items-left w-100">
                    <label class="pl-1" for="title">Dish Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Write your dish name here" value="{{old('name')}}" required>
                    {{-- SHOWING ERROR MESSAGE --}}
                    @error('name')
                        <div class="alert alert-danger">
                          {{ $message }}
                        </div>
                    @enderror
                  </div>
                  <div class="form-group d-flex flex-column align-items-left w-100">
                    <label class="pl-1" for="title">Infos</label>
                    <textarea class="form-control" name="infos">{{old('infos')}}</textarea>
                    {{-- SHOWING ERROR MESSAGE --}}
                    @error('infos')
                        <div class="alert alert-danger">
                          {{ $message }}
                        </div>
                    @enderror
                  </div>
                  <div class="form-group d-flex flex-column align-items-left w-100">
                    <label class="pl-1" for="title">Price</label>
                    <input type="number" class="form-control" name="price" placeholder="price" value="{{old('price')}}" required step="0.01">
                    {{-- SHOWING ERROR MESSAGE --}}
                    @error('price')
                        <div class="alert alert-danger">
                          {{ $message }}
                        </div>
                    @enderror
                  </div>
                    <div class="form-group d-flex flex-column align-items-left w-100">
                        <label class="pl-1">Cover image</label>
                        <input class="pl-1" type="file" class="form-control-file" name="image">
                    </div>
                  <div class="form-group d-flex flex-column align-items-left w-100">
                      <div class="btn-group btn-group-toggle" data-toggle="buttons">
                          <label class="btn btn-primary w-50">
                              <input type="radio" name="visible" id="option2" value="1" checked> Avaiable
                          </label>
                          <label class="btn btn-primary w-75">
                              <input type="radio" name="visible" id="option3" value="0"> Not Avaiable
                          </label>
                      </div>
                  </div>
                  <div class="form-group d-flex justify-content-end w-100">
                    <button type="submit" class="btn btn-success text-uppercase w-100">
                      Salva
                    </button>
                  </div>
                </form>
              </div>
            </div>
            {{--              LISTA CON TUTTI I PIATTI             --}}

            <div class="col-md-8 col-sm-12">
                <div class="card no-border border-radius-top shadow">
                    <div class="card-header text-center no-border border-radius-top font-weight-bold">
                        Ristorante {{$restaurant->restaurant_name}}
                    </div>
                    <table class="table text-center">
                        <thead>
                            <tr class="text-left">
                                <th class="text-left">Name</th>
                                <th>Price</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($restaurant->dishes as $dish)
                                <tr class="text-left">
                                    <td>
                                        <a class="text-uppercase" href="{{route('admin.dishes.show', ['dish' => $dish->id]) }}">
                                            {{ $dish->name }}
                                        </a>
                                    </td>
                                    <td/>
                                        {{ $dish->price }}
                                    </td>
                                    <td>
                                        {{-- edit --}}
                                        <a href="{{ route('admin.dishes.edit', ['dish'=> $dish->id]) }}">
                                            <span class="icon-edit"></span>
                                        </a>
                                    </td>
                                    <td>
                                        {{-- delete --}}
                                        <form class="d-inline-block" action="{{ route('admin.dishes.destroy', ['dish' => $dish->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <span class="icon-delete"></span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                    -
                                @endforelse

                        </tbody>
                    </table>
                    <div class="card-body d-flex flex-column align-items-center">

                        {{-- <ul class="list-group custom-list overflow-auto">
                            @forelse ($restaurant->dishes as $dish)
                                <li class="list-group-item d-flex justify-content-between no-border">
                                    <a class="text-uppercase" href="#">{{ $dish->name }}{{ !$loop->last ? ',' : '.' }}</a>
                                </li>
                            @empty
                                -
                            @endforelse
                        </ul> --}}
                        <form class="mt-3" action="{{route('admin.restaurants.destroy', ['restaurant' => $restaurant->id])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger text-uppercase">
                                Delete restaurant
                            </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
