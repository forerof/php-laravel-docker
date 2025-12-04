@extends('layouts.app')

@section('title', 'Carrito')

@section('content')

<!-- breadcrumb -->
<section class="breadcrumb breadcrumb_bg">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="breadcrumb_iner">
          <div class="breadcrumb_iner_item">
            <h2>Cart Products</h2>
            <p>Home <span>-</span>Cart Products</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- cart -->
<section class="cart_area padding_top">
  <div class="container">
    <div class="cart_inner">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Product</th>
              <th scope="col">Price</th>
              <th scope="col">Quantity</th>
              <th scope="col">Total</th>
            </tr>
          </thead>
          <tbody>
            @forelse($items as $item)
            <tr>
              <td>
                <div class="media">
                  <div class="d-flex">
                    @php
                      $img = optional($item->product->images->first())->image_url ?? 'img/product/single-product/cart-1.jpg';
                    @endphp
                    <img src="{{ asset($img) }}" alt="" style="max-width:100px" />
                  </div>
                  <div class="media-body">
                    <p>{{ $item->product->name }}</p>
                  </div>
                </div>
              </td>
              <td>
                <h5>${{ number_format($item->price ?? $item->product->price ?? 0, 2) }}</h5>
              </td>
              <td>
                <div class="product_count">
                  <input class="input-number" type="text" value="{{ $item->quantity }}" readonly>
                </div>
              </td>
              <td>
                <h5>${{ number_format(($item->price ?? $item->product->price ?? 0) * $item->quantity, 2) }}</h5>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="4">No hay productos en el carrito.</td>
            </tr>
            @endforelse

            <tr class="bottom_button">
              <td>
                <form action="{{ route('cart.clear') }}" method="post">
                  @csrf
                  <button class="btn_1" type="submit">Vaciar Carrito</button>
                </form>
              </td>
              <td></td>
              <td></td>
              <td>
                <div class="cupon_text float-right">
                </div>
              </td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td>
                <h5>Subtotal</h5>
              </td>
              <td>
                <h5>${{ number_format($total, 2) }}</h5>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="checkout_btn_inner float-right">
          <a class="btn_1" href="{{ route('products.index') }}">Continue Shopping</a>
          <a class="btn_1 checkout_btn_1" href="{{ route('coming-soon') }}">Proceed to checkout</a>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
