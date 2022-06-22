@extends('backend.layouts.master')
@section('title', 'Subscription list')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header mmm">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Subscription History</h1>
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
                                        <th>Shop Name</th>
                                        <th>Shop Phone</th>
                                        <th>Package Type</th>
                                        <th>Package Life Time</th>
                                        <th>Price</th>
                                        <th>End Date</th>
                                        <th>Payment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($histories as $history)
                                        <tr>
                                            <td>{{ $history->shop->name }}</td>
                                            <td>{{ $history->shop->phone }}</td>
                                            <td>{{ $history->subscription->name }}</td>
                                            <td>{{ $history->subscription->life_time . ' ' . $history->subscription->life_time_type }}</td>
                                            <td>{{ $history->amount }}</td>
                                            <td>{{ $history->shop->end_date->format('l m, Y') }}</td>
                                            <td>{{ $history->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $histories->links() }}
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
