@extends('single_shop.master')
@section('title', 'Cart')
@section('content')
    <link rel="stylesheet" href="{{ asset('single_shop/css/style.min.css') }}">
    <main class="main bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="cart-table-container">
                        <table class="table table-cart">
                            <thead>
                                <tr>
                                    <th class="thumbnail-col">Image</th>
                                    <th class="product-col">Product</th>
                                    <th class="qty-col">Quantity</th>
                                    <th class="price-col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $cart)
                                    <tr class="product-row">
                                        <td>
                                            <figure class="product-image-container">
                                                <a href="javascript:;" class="product-image">
                                                    <img src="{{ asset($cart->options->image) }}" alt="product">
                                                </a>
                                                <a href="{{ route('removeFromCart', $cart->rowId) }}"
                                                    class="btn-remove icon-cancel" title="Remove Product"></a>
                                            </figure>
                                        </td>
                                        <td class="product-col">
                                            <h5 class="product-title">
                                                {{ $cart->name }}
                                            </h5>
                                        </td>
                                        <td>
                                            {{ $cart->qty }}
                                        </td>
                                        <td>৳ {{ number_format($cart->price, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- End .cart-table-container -->
                </div>
                <!-- End .col-lg-8 -->
                <div class="col-lg-4">
                    <div class="cart-summary">
                        <h3>CART TOTALS</h3>
                        <table class="table table-totals">
                            <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td>৳{{ number_format(Cart::subtotal(), 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Shipping Charge</td>
                                    <td>৳{{ number_format($shop->shipping_charge, 2) }}</td>
                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Paid Amount</td>
                                    <td>৳{{ number_format(Cart::subtotal() + $shop->shipping_charge, 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="checkout-methods">
                            <a href="{{ route('shop.singleShopCheckout',$shop->online_market_link) }}" class="btn btn-block btn-dark">
                                Proceed to Checkout
                                <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- End .cart-summary -->
                </div>
                <!-- End .col-lg-4 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->
        <div class="mb-6"></div>
        <!-- margin -->
    </main>
@endsection
