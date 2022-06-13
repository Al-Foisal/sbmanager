@extends('backend.layouts.master')
@section('title', 'Update existing District')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Existing District</h1>
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
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('admin.districts.update', $district) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Division</label>
                                    <select class="form-control select2bs4" style="width: 100%;" name="division_id"
                                        required>
                                        <option>==Select Division==</option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}" @if($division->id === $district->division_id) selected @endif>{{ $division->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">District Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" value="{{ $district->name }}"
                                        placeholder="Enter emi month" name="name" required>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
