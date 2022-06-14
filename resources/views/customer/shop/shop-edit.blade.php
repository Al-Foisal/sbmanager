@extends('customer.layouts.master')
@section('title', 'Create new product')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create New Product</h1>
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
                        <form action="{{ route('customer.shop.updateStoreInformation', $shop) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Shop Information
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" value="{{ $shop->name }}"
                                                placeholder="Enter name" name="name" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Shop Type</label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="shop_type_id"
                                                required>
                                                <option>Select shop type</option>
                                                @foreach ($shop_type as $type)
                                                    <option value="{{ $type->id }}"
                                                        @if ($shop->shop_type_id === $type->id) selected @endif>
                                                        {{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Division</label>
                                                    <select class="form-control select2bs4" style="width: 100%;"
                                                        name="division_id">
                                                        <option value="">Select Division</option>
                                                        @foreach ($divisions as $division)
                                                            <option value="{{ $division->id }}"
                                                                @if ($shop->division_id === $division->id) selected @endif>
                                                                {{ $division->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Select District</label>
                                                    <select class="form-control select2bs4" style="width: 100%;"
                                                        name="district_id">
                                                        @if (!is_null($shop->district_id))
                                                            <option value="{{ $shop->district_id }}">
                                                                {{ $shop->district->name }}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Select Area</label>
                                                    <select class="form-control select2bs4" style="width: 100%;"
                                                        name="area_id">
                                                        @if (!is_null($shop->area_id))
                                                            <option value="{{ $shop->area_id }}">
                                                                {{ $shop->area->name }}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="address">Address<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="address"
                                                value="{{ $shop->address }}" placeholder="Enter address" name="address">
                                        </div>

                                        <div class="form-group">
                                            <label for="phone">Phone Number<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="phone"
                                                value="{{ $shop->phone }}" placeholder="Enter phone" name="phone">
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('customer.shop.updateStoreLogo', $shop) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Shop Logo
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Shop Logo<span class="text-danger">*</span></label>
                                            <input type="file" class="form-control" id="name" value="{{ $shop->name }}"
                                                placeholder="Enter name" name="image">
                                        </div>
                                        <img src="{{ asset($shop->image ?? 'images/demo.png') }}"
                                            style="height:100px;width:100px">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('customer.shop.updateStoreSocial', $shop) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Shop Social Link
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Facebook</label>
                                            <input type="text" class="form-control" id="" value="{{ $shop->facebook }}"
                                                placeholder="Enter facebook link" name="facebook">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Instagram</label>
                                            <input type="text" class="form-control" id=""
                                                value="{{ $shop->instagram }}" placeholder="Enter instagram link"
                                                name="instagram">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Youtube</label>
                                            <input type="text" class="form-control" id="" value="{{ $shop->youtube }}"
                                                placeholder="Enter youtube link" name="youtube">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('customer.shop.updateStoreOML', $shop) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Shop Online Market Link
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id=""
                                                value="{{ $shop->online_market_link }}"
                                                placeholder="Enter online market link" name="online_market_link">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <!-- form start -->

                        <div class="card-body">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Shop Banner
                                    </h3>
                                </div>
                                <div class="container">
                                    <div class="row p-3">
                                        @foreach ($slider as $slid)
                                            <form action="{{ route('customer.shop.deleteShopBanner', $slid) }}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="bg-danger"
                                                    style="border-radius: 100px;">X</button>
                                            </form>
                                            <img src="{{ asset($slid->image) }}"
                                                style="height:50px;width:100px;margin-right:20px;">
                                        @endforeach
                                    </div>
                                </div>
                                <form action="{{ route('customer.shop.storeShopBanner') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Shop Banner</label>
                                            <input type="file" class="form-control" name="image">
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
    {{-- division dependency --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="division_id"]').on('change', function() {
                var division_id = $(this).val();
                if (division_id) {
                    $.ajax({
                        url: "{{ url('/get-district/') }}/" + division_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var d = $('select[name="district_id"]').empty();
                            $('select[name="district_id"]').append(
                                '<option value="">Select District</option>');
                            $.each(data, function(key, value) {
                                $('select[name="district_id"]').append(
                                    '<option value="' + value.id + '">' + value
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="district_id"]').on('change', function() {
                var district_id = $(this).val();
                if (district_id) {
                    $.ajax({
                        url: "{{ url('/get-area/') }}/" + district_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var d = $('select[name="area_id"]').empty();
                            $('select[name="area_id"]').append(
                                '<option value="">Select Area</option>');
                            $.each(data, function(key, value) {
                                $('select[name="area_id"]').append(
                                    '<option value="' + value.id + '">' + value
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
