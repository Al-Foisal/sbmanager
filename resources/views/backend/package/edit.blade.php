@extends('backend.layouts.master')
@section('title', 'Edit Product')
@section('cssLink')
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
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Product</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('admin.packages.update', $package->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Name:<span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="Name" value="{{ $package->name }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title">Title:</label>
                                            <input type="text" name="title" class="form-control" id="title"
                                                placeholder="Title" value="{{ $package->title }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="amount">Amount:<span class="text-danger">*</span></label>
                                            <input type="text" name="amount" class="form-control" id="amount"
                                                placeholder="amount" value="{{ $package->amount }}" />
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Package Details:<span class="text-danger">*</span>
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="input-group hdtuto control-group lst increment">
                                                <input type="text" name="p_name[]" class="myfrm form-control">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-success" type="button"><i
                                                            class="far fa-plus-square"></i> Add</button>
                                                </div>
                                            </div>

                                            @foreach ($package->packageDetails as $details)
                                                <div class="clone hide">
                                                    <div class="hdtuto control-group lst input-group"
                                                        style="margin-top:10px">
                                                        <input type="text" name="p_name[]" class="myfrm form-control" value="{{ $details->name }}">
                                                        <div class="input-group-btn">
                                                            <button class="btn btn-danger" type="button"> <i
                                                                    class="far fa-minus-square"></i> Remove </button>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('jsLink')
    <!-- Summernote -->
    <script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
@endsection
@section('jsScript')
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4',
                allowClear: true
            });
        });
    </script>


    <!-- summernote Page specific script -->
    <script>
        $(function() {
            // Summernote
            $('#summernote').summernote()
            $('#summernote1').summernote()
        })
    </script>

    {{-- submenu dependency --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function() {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ url('/get-subcategory/') }}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var d = $('select[name="subcategory_id"]').empty();
                            var f = $('select[name="Childcategory_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="subcategory_id"]').append(
                                    '<option value="" selected>--select subcategory--</option>' +
                                    '<option value="' + value.id + '">' + value
                                    .name + '</option>');
                                $('select[name="childcategory_id"]').append(
                                    '<option value="" selected>--select childcategory--</option>'
                                );
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function() {
                var category_id = $(this).val();
                $('select[name="subcategory_id"]').on('change', function() {
                    var subcategory_id = $(this).val();
                    if (subcategory_id) {
                        $.ajax({
                            url: "{{ url('/get-childcategory/') }}/" + category_id +
                                "/" + subcategory_id,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                var d = $('select[name="childcategory_id"]').empty();
                                $.each(data, function(key, value) {
                                    $('select[name="childcategory_id"]').append(
                                        '<option value="" selected>--select child category--</option>' +
                                        '<option value="' + value.id +
                                        '">' + value
                                        .name + '</option>');
                                });
                            },
                        });
                    } else {
                        alert('danger');
                    }
                });
            });
        });
    </script>

    {{-- for discount price --}}
    <script type="text/javascript">
        $(function() {
            $("#selling, #discount").on("keydown keyup", sum);

            function sum() {
                var selling = Number($("#selling").val());
                var discount = Number($("#discount").val());
                var discount_price = (selling * discount) / 100;
                if (discount > 0) {
                    $("#discount_price").val(selling - discount_price);
                } else {
                    $("#discount_price").val(null);
                }
            }
        });
    </script>
@endsection
