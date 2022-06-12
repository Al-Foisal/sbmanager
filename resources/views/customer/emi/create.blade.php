@extends('customer.layouts.master')
@section('title', 'Add EMI')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add EMI</h1>
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
                        <form action="{{ route('customer.emi.month') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group consumer_body">
                                    <label>Name</label>
                                    <select class="form-control js-example-tags" style="width: 100%;" name="name" required>
                                        <option value=""></option>
                                        @foreach ($consumers as $consumer)
                                            <option value="{{ $consumer->id }}">{{ $consumer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Phone</label>
                                    <input type="text" class="form-control" id="" value="{{ old('phone') }}"
                                        placeholder="Enter phone" name="phone">
                                </div>

                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="text" class="form-control" id="" value="{{ old('address') }}"
                                        placeholder="Enter address" name="address" required>
                                </div>

                                <div class="form-group">
                                    <label for="">Total Amount</label>
                                    <input type="number" class="form-control" id="" value="{{ old('amount') }}"
                                        placeholder="Enter amount" name="amount" required min="5000">
                                </div>

                                <div class="form-group consumer_body">
                                    <label>Bank Name</label>
                                    <select class="form-control select2bs4" style="width: 100%;" name="bank_id" required>
                                        <option value=""></option>
                                        @foreach ($banks as $bank)
                                            <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
        $(".js-example-tags").select2({
            tags: true
        });
    </script>
@endsection
