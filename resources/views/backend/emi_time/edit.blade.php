@extends('customer.layouts.master')
@section('title', 'Update existing EMI Time')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Existing EMI Time</h1>
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
                        <form action="{{ route('admin.emi_times.update', $emi_time) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="emi_month">EMI Time<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="emi_month"
                                        value="{{ $emi_time->emi_month }}" placeholder="Enter emi month" name="emi_month"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="emi_parcentage">EMI Parcentage<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="emi_parcentage"
                                        value="{{ $emi_time->emi_parcentage }}" placeholder="Enter emi parcentage"
                                        name="emi_parcentage" required>
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
