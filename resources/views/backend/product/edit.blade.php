@extends('backend.layouts.master')
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
                        <form action="{{ route('admin.products.update', $product) }}" method="POST"
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
                                                        <option value="{{ $product->subcategory_id }}">{{ $product->subcategory->name??'' }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="icon">Image(optional)</label>
                                            <input type="file" class="form-control" id="icon"
                                                placeholder="Enter image" name="image">
                                        </div>
                                        <img src="{{ asset($product->image??'images/demo.png') }}" alt="">
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
