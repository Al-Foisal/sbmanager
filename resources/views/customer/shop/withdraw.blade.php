@extends('customer.layouts.master')
@section('title', 'Withdraw From Your Digital Amount')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header mmm">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Withdraw From Your Digital Amount</h1>
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
                        <form action="{{ route('customer.storeWithdraw') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Digital Balance:
                                            <b>{{ number_format($balance->amount ?? 0, 2) }}</b>/=
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Account Type:<span class="text-danger">*</span></label>
                                            <select class="form-control  select2bs4" style="width: 100%;"
                                                name="account_type" required>
                                                <option value="Bkash">Bkash</option>
                                                <option value="Rockte">Rockte</option>
                                                <option value="Nagad">Nagad</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Mobile Number<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="phone"
                                                value="{{ old('phone') }}" placeholder="Enter phone" name="phone"
                                                required>
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
                            $.each(data, function(key, value) {
                                $('select[name="subcategory_id"]').append(
                                    '<option value="" selected>==Select==</option><option value="' +
                                    value.id + '">' + value
                                    .name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>
@endsection
