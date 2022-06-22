@extends('backend.layouts.master')
@section('title', 'Subscription list')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header mmm">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Subscription in your shop</h1>
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
                        <!-- /.card-header -->
                        <div class="d-flex justify-content-start p-3">
                            <a href="{{ route('admin.subscriptions.create') }}" class="btn btn-primary mr-3">Add
                                Subscription
                            </a>
                            <a href="{{ route('admin.subscriptions.histories') }}" class="btn btn-primary">
                                Subscription History
                            </a>
                        </div>
                        <div class="card-body">

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Package Type</th>
                                        <th>Package Life Time</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Discount Price</th>
                                        <th>Cashback</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subscriptions as $subscription)
                                        <tr>
                                            <td class="d-flex justify-content-between">
                                                <a href="{{ route('admin.subscriptions.edit', $subscription->id) }}"
                                                    class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
                                            </td>
                                            <td>{{ $subscription->name }}</td>
                                            <td>{{ $subscription->life_time . ' ' . $subscription->life_time_type }}</td>
                                            <td>{{ $subscription->price }}</td>
                                            <td>{{ $subscription->discount }}</td>
                                            <td>{{ $subscription->discount_price }}</td>
                                            <td>{{ $subscription->cashback }}</td>
                                            <td>{{ $subscription->status === 1 ? 'Y' : 'N' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- {{ $products->links() }} --}}
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
