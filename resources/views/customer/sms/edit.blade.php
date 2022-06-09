@extends('customer.layouts.master')
@section('title', SHOP()->name)

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Payment</h1>
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
                <div class="card p-5">
                    <div class="col-12">
                        <b>Payment link:</b> {{ $payment->link }}<br>
                        <b>Payment status:</b> {{ $payment->status }}<br>
                        <b>Address:</b> {{ $payment->address }}<br>
                        <b>Email:</b> {{ $payment->email }}
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('customer.digital_payments.update', $payment) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="form-group consumer_body">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" list="name"
                                        value="{{ $payment->name }}" required>
                                    <datalist id="name">
                                        @foreach ($consumers as $consumer)
                                            <option value="{{ $consumer->name }}">{{ $consumer->name }}</option>
                                        @endforeach
                                    </datalist>
                                </div>
                                <div class="form-group">
                                    <label>Phone number</label>
                                    <input type="number" class="form-control" name="phone" value="{{ $payment->phone }}"
                                        placeholder="Enter phone number">
                                </div>
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" class="form-control" name="amount"
                                        value="{{ $payment->amount }}" placeholder="Enter due amount" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email"
                                        value="{{ $payment->email }}" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address"
                                        value="{{ $payment->address }}" placeholder="Enter address">
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Submit</button>

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
