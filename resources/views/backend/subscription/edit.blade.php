@extends('customer.layouts.master')
@section('title', 'Update Subscription')
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
                    <h1>Update Subscription</h1>
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
                        <form action="{{ route('admin.subscriptions.update',$subscription) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name"
                                                value="{{ $subscription->name }}" placeholder="Enter Package name" name="name"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name">Package life time<span class="text-danger">*</span></label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" id="life_time"
                                                        value="{{ $subscription->life_time }}"
                                                        placeholder="Enter Package life time" name="life_time" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select class="form-control  select2bs4" style="width: 100%"
                                                        name="life_time_type">
                                                        <option value="">Select life time</option>
                                                        <option value="Year" @if($subscription->life_time_type === 'Year') selected @endif>Year</option>
                                                        <option value="Month" @if($subscription->life_time_type === 'Month') selected @endif>Month</option>
                                                        <option value="Day" @if($subscription->life_time_type === 'Day') selected @endif>Day</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="price">Price<span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="price"
                                                value="{{ $subscription->price }}" placeholder="Enter Buying Price"
                                                name="price" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="discount">Discount(%)</label>
                                            <input type="number" value="{{ $subscription->discount }}" class="form-control"
                                                id="discount" placeholder="Enter discount" name="discount">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="discount_price">Discount Price</label>
                                            <input type="number" class="form-control" id="discount_price"
                                                value="{{ $subscription->discount_price }}" placeholder="Enter discount price"
                                                name="discount_price">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="cashback">Cashback Price</label>
                                            <input type="number" class="form-control" id="cashback"
                                                value="{{ $subscription->cashback }}" placeholder="Enter cashback price"
                                                name="cashback">
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
