@extends('backend.layouts.master')
@section('title', 'District list')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>District list</h1>
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
                            <button class="btn btn-primary btn-sm pl-5 pr-5 mb-2" data-toggle="modal"
                                data-target="#exampleModal">Create New District</button>
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Division Name</th>
                                        <th>District Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($districts as $district)
                                        <tr>
                                            <td class="d-flex justify-content-between">
                                                <a href="{{ route('admin.districts.edit', $district) }}"
                                                    class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
                                            </td>
                                            <td>{{ $district->name }}</td>
                                            <td>{{ $district->division->name }}</td>
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">District</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.districts.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Division</label>
                            <select class="form-control select2bs4" style="width: 100%;" name="division_id"
                                required>
                                <option>==Select Division==</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">district<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" value="{{ old('name') }}"
                                placeholder="Enter name" name="name" required>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
