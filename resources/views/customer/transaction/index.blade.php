@extends('customer.layouts.master')
@section('title', SHOP()->name)
@section('cssStyle')

@endsection
@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header mmm">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Transaction List</h1>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-success" style="height: 10%;vertical-align: middle;text-align:center;">
                            <h2>
                                <b>Total Transaction</b>
                            </h2>
                            <br>
                            <h2>
                                <b>৳ {{ number_format($total_transaction, 2) }}</b>
                            </h2>
                        </div>
                        <div class="card-body">
                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Consumer Information</th>
                                        <th>Price</th>
                                        <th>Payment Method</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td style="vertical-align: middle;">
                                                <span>#{{ $order->id }}</span>
                                                <br>
                                                @if ($order->consumer_id !== null)
                                                    <b>{{ GET_CONSUMER_BY_ID($order->consumer_id)->name }}</b>
                                                    <br>
                                                @endif
                                                <span>{{ $order->created_at }}</span>
                                            </td>
                                            <td style="vertical-align: middle;">৳
                                            @if($order->payment_method === 'Due')
                                            {{ number_format($order->subtotal - $order->cash, 2) }}
                                            @else
                                            {{ number_format($order->subtotal, 2) }}
                                            @endif
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                <button class="btn btn-{{ $order->button_color }} btn-xs"
                                                    style="width: 100%;letter-spacing: 2px;">
                                                    {{ $order->payment_method }} </button>
                                                @if ($order->payment_method !== 'Quick Sell')
                                                    <br>
                                                    <span>
                                                        @php
                                                            $count = 0;
                                                            foreach ($order->orderProduct as $pp) {
                                                                $count += $pp->quantity;
                                                            }
                                                        @endphp
                                                        {{ $count }} Items</span>
                                                @endif
                                            </td>
                                            @php
                                                $order_id = Crypt::encryptString($order->id);
                                            @endphp
                                            <td style="vertical-align: middle;text-align:center;">
                                                <a href="{{ route('customer.transactionDetails', $order_id) }}"
                                                    class="btn btn-dark">
                                                    VIEW DETAILS
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $orders->links() }}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

@endsection
