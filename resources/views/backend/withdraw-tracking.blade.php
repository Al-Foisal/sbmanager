@extends('backend.layouts.master')
@section('title', 'Withdraw Tracking')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Withdraw Tracking</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Withdraw</li>
                    </ol>
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
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Shop Name</th>
                                        <th>Account Type</th>
                                        <th>Phone Number</th>
                                        <th>Withdraw Amount</th>
                                        <th>Withdraw_at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($withdraw as $item)
                                        <tr>
                                            <td>{{ $item->shop->name }}</td>
                                            <td>{{ $item->account_type }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->amount }}</td>
                                            <td>{{ $item->created_at->format('l m, Y H:i:s A') }}</td>
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
