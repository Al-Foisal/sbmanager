@extends('customer.layouts.master')
@section('title', SHOP()->name)
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
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('backend/css/icheck-bootstrap/icheck-bootstrap.min.css') }}">

@endsection
@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header mmm">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('customer.due.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex justify-content-start">
                                    <div class="form-group mr-2">
                                        <label for="">Select Date</label>
                                        <input type="datetime-local" name="current_date" id="" class="form-control"
                                            value="{{ date('Y-m-d') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Add Image</label>
                                        <input type="file" name="image" id="image" class="form-control">
                                    </div>
                                </div>

                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Select to due category</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <!-- checkbox -->
                                                <div class="form-group d-flex justify-content-between">
                                                    <div class="icheck-success">
                                                        <input type="radio" name="due_to" id="radioSuccess1"
                                                            value="Consumer" checked>
                                                        <label for="radioSuccess1">
                                                            Consumer
                                                        </label>
                                                    </div>
                                                    <div class="icheck-success">
                                                        <input type="radio" name="due_to" id="radioSuccess2"
                                                            value="Supplier">
                                                        <label for="radioSuccess2">
                                                            Supplier
                                                        </label>
                                                    </div>
                                                    <div class="icheck-success">
                                                        <input type="radio" name="due_to" id="radioSuccess3"
                                                            value="Employee">
                                                        <label for="radioSuccess3">
                                                            Employee
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Select to due mode</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <!-- checkbox -->
                                                <div class="form-group d-flex justify-content-between">
                                                    <div class="icheck-danger">
                                                        <input type="radio" name="due_type" id="radiodanger4"
                                                            value="Due" checked>
                                                        <label for="radiodanger4">
                                                            Due
                                                        </label>
                                                    </div>
                                                    <div class="icheck-success">
                                                        <input type="radio" name="due_type" id="radioSuccess5"
                                                            value="Deposit">
                                                        <label for="radioSuccess5">
                                                            Deposit
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{--  --}}
                                <div class="form-group consumer_body">
                                    <label>Name</label>
                                    <select class="form-control js-example-tags" style="width: 100%;" name="due_to_id">
                                        @if ($rc)
                                            <option value="{{ $rc->id }}">{{ $rc->name }}</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Phone number</label>
                                    <input type="number" class="form-control" name="phone"
                                        placeholder="Enter phone number" @if ($rc) value="{{ $rc->phone ?? '' }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" class="form-control" name="amount" placeholder="Enter due amount"
                                        @if ($rc) value="{{ $amount }}" @endif required>
                                </div>
                                <div class="form-group">
                                    <label>Due details(optional)</label>
                                    <textarea rows="2" class="form-control" name="details" placeholder="Enter due details"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </form>
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
@endsection
@section('jsScript')
    {{-- submenu dependency --}}
    <script type="text/javascript">
        $(".js-example-tags").select2({
            tags: true
        });

        $(document).ready(function() {
            $('input[name="due_to"]').on('click', function() {
                var category = $(this).val();
                if (category) {
                    $.ajax({
                        url: "{{ url('/get-category/') }}/" + category,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var d = $('select[name="due_to_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="due_to_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            })


        });
    </script>
@endsection
