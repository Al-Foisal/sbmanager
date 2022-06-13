@extends('backend.layouts.master')
@section('title', 'Shop Type')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Shop Type</h1>
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
                                data-target="#exampleModal">Create New Shop Type</button>
                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Shop Type Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($shop_type as $shop)
                                        <tr>
                                            <td class="d-flex justify-content-between">
                                                <a href="{{ route('admin.shop_types.edit', $shop) }}"
                                                    class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
                                                
                                            </td>
                                            <td>{{ $shop->name }}</td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Bank</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.shop_types.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Shop Type Name<span class="text-danger">*</span></label>
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
