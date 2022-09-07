@extends('customer.layouts.master')
@section('title', 'dashboard')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header mmm">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Customer Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-notes-medical"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Today's Sale</span>
                            <span class="info-box-number">৳ {{ $sales }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-notes-medical"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Today's Expenses</span>
                            <span class="info-box-number">৳ {{ $expenses }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-notes-medical"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Today's Due</span>
                            <span class="info-box-number">৳ {{ $due }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-notes-medical"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Today's Balance</span>
                            <span class="info-box-number">৳ {{ $balance }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </section>
@php
    $access = App\Models\SubscriptionHistory::where('shop_id',SID())->orderBy('id','desc')->first();
@endphp
    <section class="content">
        <div class="container-fluid">
            <div class="">
                <h1>Current subscription status</h1>
                <p>Package Type: <b>{{ $access->subscription->package_type }}</b></p>
                <p>Package Name: <b>{{ $access->subscription->life_time . ' ' . $access->subscription->life_time_type }} Subscription</b></p>
                <p>Package Expiration: <b>{{ SHOP()->end_date }}</b></p>
            </div>
        </div>
    </section>
@endsection
