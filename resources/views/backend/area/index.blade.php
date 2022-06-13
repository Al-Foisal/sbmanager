@extends('backend.layouts.master')
@section('title', 'Area')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Area List</h1>
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
                        <div class="card-body">
                            <a href="{{ route('admin.areas.create') }}" class="btn btn-outline-primary">Add Area</a>
                            <br>
                            <br>
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Division Name</th>
                                        <th>District Name</th>
                                        <th>Area Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($areas as $area)
                                        <tr>
                                            <td class="d-flex justify-content-between">
                                                <a href="{{ route('admin.areas.edit', $area) }}"
                                                    class="btn btn-info btn-xs"> <i class="fas fa-edit"></i> </a>
                                            </td>
                                            <td>{{ $area->division->name }}</td>
                                            <td>{{ $area->district->name }}</td>
                                            <td>{{ $area->name }}</td>
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
