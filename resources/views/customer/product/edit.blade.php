@extends('customer.layouts.master')
@section('title', 'Update existing product')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header mmm">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Existing Product</h1>
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
                        <form action="{{ route('customer.products.update', $product) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Product Information
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name"
                                                value="{{ $product->name }}" placeholder="Enter name" name="name"
                                                required>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="buying_price">Buying Price<span
                                                            class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" id="buying_price"
                                                        value="{{ $product->buying_price }}"
                                                        placeholder="Enter Buying Price" name="buying_price" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="price">Selling price<span
                                                            class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" id="price"
                                                        value="{{ $product->price }}" placeholder="Enter selling price"
                                                        name="price" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="quantity">Quantity<span
                                                            class="text-danger">*</span></label>
                                                    <input type="number" value="{{ $product->quantity }}"
                                                        class="form-control" id="quantity" placeholder="Enter quantity"
                                                        name="quantity" required>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Product Details
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <textarea id="summernote" placeholder="Enter product details" name="details">{!! $product->details !!}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="card card-success">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Category:<span class="text-danger">*</span></label>
                                                    <select class="form-control  select2bs4" style="width: 100%;"
                                                        name="category_id" required>
                                                        <option value="">--select category--</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                @if ($product->category_id == $category->id) selected @endif>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Subcategory:</label>
                                                    <select class="form-control  select2bs4"
                                                        data-placeholder="Select subcategory" style="width: 100%"
                                                        name="subcategory_id">

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <input type="checkbox" name="online" value="1" id="online"
                                                        @if ($product->online === 1) checked @endif>
                                                    <label for="online">Publish product online</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label>Product unit:</label>
                                                    <select class="form-control  select2bs4" style="width: 100%"
                                                        name="unit">
                                                        @if ($product->unit !== null)
                                                            <option value="{{ $product->unit }}" selected>{{ $product->unit }}
                                                            </option>
                                                        @endif
                                                        <option value=""></option>
                                                        <option value="ft">ft</option>
                                                        <option value="sq.ft">sq.ft</option>
                                                        <option value="sq.m">sq.m</option>
                                                        <option value="kg">kg</option>
                                                        <option value="gm">gm</option>
                                                        <option value="piece">piece</option>
                                                        <option value="km">km</option>
                                                        <option value="meter">meter</option>
                                                        <option value="liter">liter</option>
                                                        <option value="ml">ml</option>
                                                        <option value="ton">ton</option>
                                                        <option value="12 piece">12 piece</option>
                                                        <option value="6 piece">6 piece</option>
                                                        <option value="4 piece">4 piece</option>
                                                        <option value="inch">inch</option>
                                                        <option value="hand">hand</option>
                                                        <option value="sack">sack</option>
                                                        <option value="packet">packet</option>
                                                        <option value="set">set</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body d-flex justify-content-start">
                                                <div class="form-group mr-2">
                                                    <label for="wholesale_price">wholesale price</label>
                                                    <input type="text" class="form-control" id="wholesale_price"
                                                        value="{{ $product->wholesale_price }}"
                                                        placeholder="Enter wholesale_price" name="wholesale price">
                                                </div>
                                                <div class="form-group">
                                                    <label for="wholesale_quantity">wholesale quantity</label>
                                                    <input type="number" class="form-control" id="wholesale_quantity"
                                                        value="{{ $product->wholesale_quantity }}"
                                                        placeholder="Enter wholesale quantity" name="wholesale_quantity">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="stock_alert">Stock alert</label>
                                                    <input type="number" class="form-control" id="stock_alert"
                                                        value="{{ $product->stock_alert }}"
                                                        placeholder="Enter stock_alert" name="stock alert">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="vat">Vat(%)</label>
                                                    <input type="number" value="{{ $product->vat }}"
                                                        class="form-control" id="vat" placeholder="Enter vat" name="vat">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="warranty">Warranty</label>
                                                    <div class="d-flex justify-content-start">
                                                        <input type="number" class="form-control" id="warranty"
                                                            value="{{ $product->warranty }}"
                                                            placeholder="Enter Buying Price" name="warranty">
                                                        <select class="form-control" name="warranty_type">
                                                            @if (!empty($product->warranty_type))
                                                                <option value="{{ $product->warranty_type }}" selected>
                                                                    {{ $product->warranty_type }}</option>
                                                            @endif
                                                            <option value=""></option>
                                                            <option value="Day">Day</option>
                                                            <option value="Week">Week</option>
                                                            <option value="Month">Month</option>
                                                            <option value="Year">Year</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="discount">Discount</label>
                                                    <div class="d-flex justify-content-start">
                                                        <input type="number" class="form-control" id="discount"
                                                            value="{{ $product->discount }}"
                                                            placeholder="Enter Buying Price" name="discount">
                                                        <select class="form-control" name="discount_type">
                                                            @if (!empty($product->discount_type))
                                                                <option value="{{ $product->discount_type }}" selected>
                                                                    {{ $product->discount_type }}</option>
                                                            @endif
                                                            <option value=""></option>
                                                            <option value="1">$</option>
                                                            <option value="2">%</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="icon">Image(optional)</label>
                                                    <input type="file" class="form-control" id="icon"
                                                        placeholder="Enter image" name="image">
                                                </div>
                                            </div>
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
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
