@extends('single_shop.master')
@section('title', 'Checkout')
@section('content')
    <link rel="stylesheet" href="{{ asset('single_shop/css/style.min.css') }}">
    <main class="main bg-white">
        <div class="container checkout-container">
            <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
                <li class="disabled">
                    <a href="#">Checkout</a>
                </li>
            </ul>
            <form action="{{ route('shop.singleShopPlaceOrder', $shop->online_market_link) }}" method="post"
                id="checkout-form">
                @csrf
                <div class="row">
                    <div class="col-lg-7">
                        <ul class="checkout-steps">
                            <li>
                                <h2 class="step-title">Billing details</h2>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>
                                                Full name
                                                <abbr class="required" title="required">*</abbr>
                                            </label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Your full name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone<abbr class="required" title="required">*</abbr></label>
                                            <input type="text" name="phone" placeholder="Enter phone" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-1 pb-2">
                                            <label>
                                                Email<abbr class="required" title="required">*</abbr>
                                            </label>
                                            <input type="text" class="form-control" name="email" placeholder="Enter email"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Division<abbr class="required" title="required">*</abbr></label>
                                            <select class="form-control " style="width: 100%;" name="division_id" required>
                                                <option value="">Select Division</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}"
                                                        @if ($shop->division_id === $division->id) selected @endif>
                                                        {{ $division->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Select District<abbr class="required"
                                                    title="required">*</abbr></label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="district_id"
                                                required>
                                                @if (!is_null($shop->district_id))
                                                    <option value="{{ $shop->district_id }}">
                                                        {{ $shop->district->name }}</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Select Area<abbr class="required" title="required">*</abbr></label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="area_id"
                                                required>
                                                @if (!is_null($shop->area_id))
                                                    <option value="{{ $shop->area_id }}">
                                                        {{ $shop->area->name }}</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pickup Point<abbr class="required"
                                                    title="required">*</abbr></label>
                                            <select class="form-control " style="width: 100%;" name="pickup_point"
                                                required>
                                                <option value="Home Delivery">Home Delivery</option>
                                                <option value="Selling Point">Selling Point</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Payment Method<abbr class="required"
                                                    title="required">*</abbr></label>
                                            <select class="form-control " style="width: 100%;" name="payment_method"
                                                required>
                                                <option value="Cash on Delivery">Cash on Delivery</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Zip Code
                                        <abbr class="required" title="required">*</abbr></label>
                                    <input type="text" name="zip_code" placeholder="Zip code" class="form-control"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label class="order-comments">Address<abbr class="required"
                                            title="required">*</abbr></label>
                                    <textarea class="form-control" name="address" required></textarea>
                                </div>

                            </li>
                        </ul>
                    </div>
                    <!-- End .col-lg-8 -->
                    <div class="col-lg-5">
                        <div class="order-summary">
                            <h3>YOUR ORDER</h3>
                            <table class="table table-mini-cart">
                                <thead>
                                    <tr>
                                        <th colspan="2">Product</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carts as $cart)
                                        <tr>
                                            <td class="product-col">
                                                <h3 class="product-title">
                                                    {{ $cart->name }} ×
                                                    <span class="product-qty">{{ $cart->qty }}</span>
                                                </h3>
                                            </td>
                                            <td class="price-col">
                                                <span>৳{{ number_format($cart->price * $cart->qty, 2) }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                                    <input type="hidden" name="total" value="{{ $total }}">
                                    <input type="hidden" name="subtotal" value="{{ Cart::subtotal() }}">
                                    <input type="hidden" name="shipping_charge" value="{{ $shop->shipping_charge }}">

                                    <tr class="cart-subtotal">
                                        <td>Subtotal</td>
                                        <td class="price-col">৳{{ number_format(Cart::subtotal(), 2) }}</td>
                                    </tr>
                                    <tr class="cart-subtotal">
                                        <td>Shipping Charge</td>
                                        <td class="price-col">৳{{ number_format($shop->shipping_charge, 2) }}</td>
                                    </tr>
                                    <tr class="cart-subtotal">
                                        <td>Paid Amount</td>
                                        <td class="price-col">৳{{ number_format($total, 2) }}</td>
                                    </tr>

                                </tfoot>
                            </table>

                            <button type="submit" class="btn btn-dark btn-place-order" form="checkout-form">
                                Place order
                            </button>
                        </div>
                        <!-- End .cart-summary -->
                    </div>
                    <!-- End .col-lg-4 -->
                </div>
            </form>
            <!-- End .row -->
        </div>
        <!-- End .container -->
    </main>
@endsection
@section('js')
    {{-- division dependency --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="division_id"]').on('change', function() {
                var division_id = $(this).val();
                if (division_id) {
                    $.ajax({
                        url: "{{ url('/get-district/') }}/" + division_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var d = $('select[name="district_id"]').empty();
                            $('select[name="district_id"]').append(
                                '<option value="">Select District</option>');
                            $.each(data, function(key, value) {
                                $('select[name="district_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="district_id"]').on('change', function() {
                var district_id = $(this).val();
                if (district_id) {
                    $.ajax({
                        url: "{{ url('/get-area/') }}/" + district_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var d = $('select[name="area_id"]').empty();
                            $('select[name="area_id"]').append(
                                '<option value="">Select Area</option>');
                            $.each(data, function(key, value) {
                                $('select[name="area_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>
@endsection
