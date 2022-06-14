@extends('market.master')

@section('content')
    <div class="container">
        <div class="row">
            <h4>Your Order</h4>
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
                                <a href="" class="btn btn-success btn-sm">PayNow</a>
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
    </div>
@endsection
