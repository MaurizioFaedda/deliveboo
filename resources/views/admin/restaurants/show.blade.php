@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 d-flex mb-5">
                <div class="col-md-4 col-sm-12">
                    <div class="card no-border border-radius-top shadow p-4">
                        @if($restaurant->img_path_rest)
                            <div class="img-wrapper py-5 h-100">
                                <img class="img-fluid" src="{{ asset('storage/' . $restaurant->img_path_rest)}}" alt="{{$restaurant->restaurant_name}}">
                            </div>
                        @else
                            <img src="{{ asset('img/img_not_available.png')}}" alt="not img">
                        @endif
                        <div>
                            <ul>
                                @forelse ($restaurant->types as $type)
                                <li>{{ $type->type }}</li>
                                @empty
                                <li>Non sono state inserite tipologie</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12">
                    <div class="card no-border border-radius-top shadow p-4 h-100">
                        <p class="my-4 p-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <form class="mt-3" action="{{route('admin.restaurants.destroy', ['restaurant' => $restaurant->id])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger text-uppercase">
                                Delete restaurant
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{--              FORM PER CREAZIONE PIATTO             --}}
            <div class="col-md-4 col-sm-12 h-100 mb-4">

                <div class="card no-border border-radius-top shadow">
                    <div class="card-header card-header text-center no-border border-radius-top p-3">
                        <h5 class="mb-0">Aggiungi un nuovo piatto</h5>
                    </div>
                    <form class="d-flex flex-column align-items-left py-3 px-3" action="{{route('admin.dishes.store')}}" method="post" enctype="multipart/form-data">
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

            <div class="col-md-8 col-sm-12 h-100">
                <div class="card-header backgmain text-center no-border border-radius-top font-weight-bold">
                    <h5 class="mb-0 text-white">{{$restaurant->restaurant_name}}</h5>
                </div>
                <table class="table text-center mb-0 bg-white">
                    <thead>
                        <tr class="text-left">
                            <th class="text-left">Name</th>
                            <th>Price</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                </table>
                <div class="card rounded-0 no-border shadow overflow-auto">

                    <table class="table text-center mb-0">

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
                                <td class="align-middle">
                                    {{-- delete --}}
                                    <form class="d-inline-block" action="{{ route('admin.dishes.destroy', ['dish' => $dish->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-link delete-restaurant" type="submit">
                                            <span class="icon-delete"></span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <p class="p-3 text-center">Inserisci dei piatti</p>
                        @endforelse
                    </tbody>
                </table>

            </div>

            </div>
        </div>
    </div>
@endsection
