@extends('layouts.guest')

@section('content')
    <div class="mt-5">

        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (Cart::count() > 0)

          <h2 class="ml-5">{{ Cart::count() }} item(s) in Shopping Cart</h2>
          <ul>
              @foreach (Cart::content() as $item)
                  <li>
                      {{$item->model->name}},
                      {{$item->model->price}},

                  </li>
                  {{-- <div class="cart-table-row-left">
                        <a href="{{ route('restaurant.show', $item->model->restaurant_id) }}"><img src="{{ productImage($item->model->image) }}" alt="item" class="cart-table-img"></a>
                        <div class="cart-item-details">
                            <div class="cart-table-item"><a href="{{ route('shop.show', $item->model->slug) }}">{{ $item->model->name }}</a></div>
                            <div class="cart-table-description">{{ $item->model->details }}</div>
                        </div>
                    </div> --}}
              @endforeach
          </ul>
      @else

            <h3>No items in Cart!</h3>
            <div class="spacer"></div>
            <a href="" class="button">Continue Shopping</a>
            <div class="spacer"></div>

        @endif
    </div>
@endsection
