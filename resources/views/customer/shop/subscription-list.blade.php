@extends('customer.layouts.master')
@section('title', 'Subscription list')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header mmm">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Subscription List</h1>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Package Info</th>
                                        <th>Package Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subscriptions as $subscription)
                                        <tr>
                                            <td style="vertical-align: middle">
                                                Package Type: <b>{{ $subscription->package_type }}</b> <br>
                                                Package Name: <b>{{ $subscription->life_time . ' ' . $subscription->life_time_type }} Subscription</b>  <br>
                                                Duration:
                                                <b>{{ $subscription->life_time . ' ' . $subscription->life_time_type }}</b>
                                            </td>
                                            <td style="vertical-align: middle">
                                                @if ($subscription->discount > 0)
                                                    Discount: <b>{{ $subscription->discount . '%' }}</b> <br>
                                                    New Price: <b>{{ $subscription->discount_price }}/=</b>
                                                    <br>
                                                    <del>Old Price: <b>{{ $subscription->price }}/=</b></del>
                                                @else
                                                    Price: <b>{{ $subscription->price }}/=</b>
                                                @endif
                                            </td>
                                            <td style="vertical-align: middle">
                                                <a href="{{ route('customer.shop.subscriptionBooking', Crypt::encryptString($subscription->id)) }}"
                                                    class="btn btn-info btn-sm">Subscribe Now</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
    <!-- /.content -->
@endsection
