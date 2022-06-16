@extends('customer.layouts.master')
@section('title', 'Company Info')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>QR Code</h1>
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
                        <form action="{{ route('customer.qrcodes.index') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Bkash QR Code</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="bkash"
                                                        id="exampleInputFile">
                                                </div>
                                            </div>
                                            @if (!empty($info->bkash))
                                                <img src="{{ asset($info->bkash) }}" style="height: 200px;width:200px;margin:20px;" alt="">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nagad QR Code</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="nagad"
                                                        id="">
                                                </div>
                                            </div>
                                            @if (!empty($info->nagad))
                                                <img src="{{ asset($info->nagad) }}" style="height: 200px;width:200px;margin:20px;" alt="">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Rocket QR Code</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="rocket"
                                                        id="">
                                                </div>
                                            </div>
                                            @if (!empty($info->rocket))
                                                <img src="{{ asset($info->rocket) }}" style="height: 200px;width:200px;margin:20px;" alt="">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Others QR Code</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="others"
                                                        id="exampleInputFile">
                                                </div>
                                            </div>
                                            @if (!empty($info->others))
                                                <img src="{{ asset($info->others) }}" style="height: 200px;width:200px;margin:20px;" alt="">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- /.card-body -->
                            
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
