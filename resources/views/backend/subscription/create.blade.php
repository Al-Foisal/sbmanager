@extends('backend.layouts.master')
@section('title', 'Create new Subscription')
@section('cssStyle')
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endsection
@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header mmm">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create New Subscription</h1>
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
                        <form action="{{ route('admin.subscriptions.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Package Type<span class="text-danger">*</span></label>
                                            <select class="form-control  select2bs4" style="width: 100%" name="package_type"
                                                data-placeholder="Select package type" required>
                                                <option value="">Package Type</option>
                                                <option value="Standard">Standard</option>
                                                <option value="Advanced">Advanced</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Package life time<span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="life_time"
                                                value="{{ old('life_time') }}" placeholder="Enter Package life time"
                                                name="life_time" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Package life time Type<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <select class="form-control  select2bs4" style="width: 100%"
                                                name="life_time_type">
                                                <option value="">Select life time</option>
                                                <option value="Year">Year</option>
                                                <option value="Month">Month</option>
                                                <option value="Day">Day</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="price">Price<span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="price"
                                                value="{{ old('price') }}" placeholder="Enter Buying Price" name="price"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="discount">Discount(%)</label>
                                            <input type="number" value="{{ old('discount') }}" class="form-control"
                                                id="discount" placeholder="Enter discount" name="discount">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="discount_price">Discount Price</label>
                                            <input type="number" class="form-control" id="discount_price"
                                                value="{{ old('discount_price') }}" placeholder="Enter discount price"
                                                name="discount_price">
                                        </div>
                                    </div>

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


@section('jsScript')

    {{-- for discount price --}}
    <script type="text/javascript">
        $(function() {
            $("#price, #discount").on("keydown keyup", sum);

            function sum() {
                var price = Number($("#price").val());
                var discount = Number($("#discount").val());
                var discount_price = (price * discount) / 100;
                if (discount > 0) {
                    $("#discount_price").val(price - discount_price);
                } else {
                    $("#discount_price").val(null);
                }
            }
        });
    </script>
@endsection
