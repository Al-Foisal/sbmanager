@extends('customer.layouts.master')
@section('title', 'Subscription Booking')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header mmm">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Subscription Booking</h1>
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
                    <div class="">
                        <div class="card-body" style="vertical-align: middle">
                            <form action="{{ url('/subscription-payment') }}" method="post">
                                @csrf

                                <input type="hidden" name="shop_id" value="{{ SID() }}">
                                <input type="hidden" name="subscription_id" value="{{ $subscription->id }}">

                                <div class="card border-success mb-3" style="max-width: 18rem;margin:auto;">
                                    <div class="card-header bg-transparent border-success">Package Details</div>
                                    <div class="card-body text-dark ">
                                        <h5 class="card-title">
                                            <b>Pckage Name: </b>{{ $subscription->name }}
                                        </h5>
                                        <h5 class="card-title">
                                            <b>Pckage Duration:
                                            </b>{{ $subscription->life_time . ' ' . $subscription->life_time_type }}
                                        </h5>
                                        <h5 class="card-title">
                                            <b>Pckage Price: </b>
                                            @if ($subscription->discount > 0)
                                                {{ $subscription->discount_price }}/=
                                            @else
                                                {{ $subscription->price }}/=
                                            @endif
                                        </h5>
                                    </div>
                                    <div class="card-footer bg-transparent" style="border-top: 1px solid #28a745">
                                        <button type="submit" class="btn btn-info btn-block">Pay</button>
                                    </div>
                                </div>
                            </form>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($histories as $history)
                                        <tr>
                                            <td style="vertical-align: middle">
                                                Name: <b>{{ $history->subscription->name }}</b> <br>
                                                Duration:
                                                <b>{{ $subscription->life_time . $subscription->life_time_type }}</b>
                                            </td>
                                            <td style="vertical-align: middle">
                                                
                                                    Price: <b>{{ $history->amount }}/=</b>
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
