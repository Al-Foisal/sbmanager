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
                    <h1>{{ $income_book->name }}</h1>
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
                            <form action="{{ route('customer.income.storeIncomeBookList') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="income_book_id" value="{{ $income_book->id }}">
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
                                <div class="form-group">
                                    <label>Income reason</label>
                                    <input type="text" class="form-control" name="reason"
                                        placeholder="Enter income reason">
                                </div>
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" class="form-control" name="amount"
                                        placeholder="Enter income amount" required>
                                </div>
                                <div class="form-group">
                                    <label>Income details(optional)</label>
                                    <textarea rows="2" class="form-control" name="details" placeholder="Enter Income details"></textarea>
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
