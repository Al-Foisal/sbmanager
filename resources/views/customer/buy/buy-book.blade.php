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
                    <h1>Buy List</h1>
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
                                <b>Total Buy</b>
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
                                        <th>Supplier Information</th>
                                        <th>Price</th>
                                        <th>Payment Method</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($buys as $buy)
                                        <tr>
                                            <td style="vertical-align: middle;">
                                                <span>#{{ $buy->id }}</span>
                                                <br>
                                                @if ($buy->supplier_id !== null)
                                                    <b>{{ GET_CONSUMER_BY_ID($buy->supplier_id)->name }}</b>
                                                    <br>
                                                @endif
                                                <span>{{ $buy->created_at }}</span>
                                            </td>
                                            <td style="vertical-align: middle;">৳
                                                {{ number_format($buy->subtotal, 2) }}</td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                <button class="btn btn-{{ $buy->button_color }} btn-xs"
                                                    style="width: 100%;letter-spacing: 2px;">
                                                    {{ $buy->payment_method }} </button>
                                                <br>
                                                <span>
                                                    @php
                                                        $count = 0;
                                                        foreach ($buy->buyProduct as $pp) {
                                                            $count += $pp->quantity;
                                                        }
                                                    @endphp
                                                    {{ $count }} Items</span>
                                            </td>
                                            @php
                                                $order_id = Crypt::encryptString($buy->id);
                                            @endphp
                                            <td style="vertical-align: middle;text-align:center;">
                                                <a href="{{ route('customer.buy.buyBookDetails', $order_id) }}"
                                                    class="btn btn-dark">
                                                    VIEW DETAILS
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $buys->links() }}
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
