@extends('customer.layouts.master')
@section('title', SHOP()->name)
@section('cssStyle')
    <style>
        .vv:hover {
            background: black;
            color: white;
        }
    </style>
@endsection
@section('backend')

    <section class="content-header">
        <div class="container">
            <div class="row p-5">
                <div class="col-6">
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-info btn-sm pl-5 pr-5">৳ 0 Balance</button>

                        <a href="{{ route('customer.topup.details') }}" class="btn btn-primary">Topup History</a>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <form action="" method="post">
        <section class="content-header">
            <div class="container">
                <div class="row p-5">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Phone Number:</label>
                            <input type="text" class="form-control" name="phone" placeholder="Enter phone number"
                                style="background: #f4f6f9;border:1px solid;" />
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div class="text-center">
            <button class="btn btn-primary text-center mb-5" type="submit" style="padding: 5px 15% 5px 15%">Sent
                Load</button>
        </div>
    </form>

@endsection
