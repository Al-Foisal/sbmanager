@extends('market.master')

@section('content')
    <div class="container">
        <div class="row">
            <h4>Your Cart</h4>
            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Payment Status</th>
                        <th scope="col">Order Now</th>
                        <th scope="col">Order Status</th>
                        <th scope="col">Cancel Order</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach ($carts as $cart)
                            <td>{{ $cart->name }}</td>
                            <td>{{ $cart->qty }}</td>
                            <td>{{ $cart->price }}</td>
                            <td>
                                <span class="badge bg-dark">Pending</span>
                            </td>
                            <td>
                                <form action="{{ route('onlineMarketPayment') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="shop_id"
                                        value="{{ session()->get('online_market_shop') }}">
                                    <input type="hidden" name="product_id" value="{{ $cart->id }}">
                                    <input type="hidden" name="quantity" value="{{ $cart->qty }}">
                                    <button type="submit" class="btn btn-success btn-sm">Pay Now</button>
                                </form>
                            </td>
                            <td>
                                <span class="badge bg-dark">Pending</span>
                            </td>
                            <td>
                                <a href="{{ route('removeFromCart', $cart->rowId) }}"
                                    class="btn btn-danger btn-sm">Cancel</a>
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
        <hr>
        <div class="row">
            <h4>Your Order</h4>
            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->product->name }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->amount }}</td>
                            <td>{{ $product->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
