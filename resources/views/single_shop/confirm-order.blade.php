@extends('single_shop.master')
@section('title', 'Checkout')
@section('css')
    <script>
        function printContent(el) {
            var restorepage = $('body').html();
            var printcontent = $('#' + el).clone();
            $('body').empty().html(printcontent);
            window.print();
            $('body').html(restorepage);
        }
    </script>
@endsection
@section('content')
    <div class="container">
        <div class="card" id="print">
            <div class="card-header">
                Order ID: #{{ $order->id }}, Invoice
                <strong>{{ $order->created_at->format('d/m/Y') }}</strong>
                <span style="float: right;"> <strong>Status:</strong>
                    @if ($order->status == 1)
                        Pending
                    @elseif($order->status == 2)
                        Confirmed
                    @endif
                </span>

            </div>
            <img src="{{ asset($shop->image) }}" style="height:100px;width:100px" alt="">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6" style="width: 50%;float:left;">
                        <h6 class="mb-3">From:</h6>
                        <div>
                            Name: <strong>{{ config('app.name') }}</strong>
                        </div>
                        <div>Address: {{ $shop->address }}</div>
                        <div>Email: {{ $shop->email }}</div>
                        <div>Phone: {{ $shop->phone }}</div>
                    </div>

                    <div class="col-sm-6" style="width: 50%;float:left;">
                        <h6 class="mb-3">To:</h6>
                        <div>
                            Name: <strong>{{ $order->name }}</strong>
                        </div>
                        <div>Address: {{ $order->address }}</div>
                        <div>Email: {{ $order->email }}</div>
                        <div>Phone: {{ $order->phone }}</div>
                    </div>



                </div>

                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Item</th>

                                <th class="right">Unit Cost</th>
                                <th class="center">Qty</th>
                                <th class="right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->onlineOrderProducts as $key => $product)
                                <tr>
                                    <td class="center">{{ ++$key }}</td>
                                    <td class="left strong">{{ $product->prod->name }}</td>

                                    <td class="right">৳{{ $product->price }}</td>
                                    <td class="center">{{ $product->quantity }}</td>
                                    <td class="right">
                                        ৳{{ number_format($product->price * $product->quantity, 1) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-sm-7">

                    </div>

                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td>৳{{ number_format($order->subtotal, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Shipping Charge</td>
                                    <td>৳{{ number_format($order->shipping_charge, 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>PAID AMOUNT</strong>
                                    </td>
                                    <td class="right">
                                        <strong>৳{{ number_format($order->total, 2) }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
        <button id="print" onclick="printContent('print');" class="btn btn-success btn-sm">Print Invoice</button>
    </div>
@endsection
