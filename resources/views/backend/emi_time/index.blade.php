@extends('backend.layouts.master')
@section('title', 'EMI Times')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>EMI Times</h1>
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
                                data-target="#exampleModal">Create New EMI Time</button>
                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>EMI Times</th>
                                        <th>EMI Parcentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($emi_time as $emi_time)
                                        <tr>
                                            <td class="d-flex justify-content-between">
                                                <a href="{{ route('admin.emi_times.edit', $emi_time) }}"
                                                    class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('admin.emi_times.destroy', $emi_time) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        onclick="return(confirm('Are you sure want to delete this item?'))"
                                                        class="btn btn-danger btn-xs"> <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>{{ $emi_time->emi_month }}</td>
                                            <td>{{ $emi_time->emi_parcentage }}</td>
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
                    <h5 class="modal-title" id="exampleModalLabel">EMI Time</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.emi_times.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="emi_month">EMI Time<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="emi_month" value="{{ old('emi_month') }}"
                                placeholder="Enter emi month" name="emi_month" required>
                        </div>

                        <div class="form-group">
                            <label for="emi_parcentage">EMI Parcentage<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="emi_parcentage"
                                value="{{ old('emi_parcentage') }}" placeholder="Enter emi parcentage"
                                name="emi_parcentage" required>
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
