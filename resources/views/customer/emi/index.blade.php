@extends('customer.layouts.master')
@section('title', 'Category')

@section('backend')
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>EMI List</h1>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ route('customer.emi.create') }}" class="btn btn-primary float-sm-right">Add EMI</a>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($emis as $emi)
                                        <tr>
                                            <td>
                                                {{ $emi->name }}
                                                <br>
                                                {{ $emi->phone }}
                                            </td>
                                            <td>৳ {{ $emi->amount }}</td>
                                            <td class="badge badge-danger badge-sm">{{ $emi->status }}</td>
                                            
                                            <td class="text-center">
                                                <a href="{{ route('customer.emi.details', $emi) }}"
                                                    class="btn btn-info "> View Details </a>

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
