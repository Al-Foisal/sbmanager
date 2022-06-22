@extends('customer.layouts.master')
@section('title', 'Product list')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header mmm">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product in your shop</h1>
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
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="d-flex justify-content-satrt mt-3 ml-3">
                            <a href="{{ route('customer.products.create') }}" class="btn btn-primary mr-3">Add
                                Product
                            </a>
                            <a href="{{ route('customer.products.stockAlert') }}" class="btn btn-primary">Stock Alert
                            </a>
                        </div>
                        <div class="card-body">

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td class="d-flex justify-content-between">
                                                <a href="{{ route('customer.products.edit', Crypt::encryptString($product->id)) }}"
                                                    class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('customer.products.destroy', $product) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        onclick="return(confirm('Are you sure want to delete this item?'))"
                                                        class="btn btn-danger btn-xs"> <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <img src="{{ asset($product->image === null ? 'images/demo.png' : $product->image) }}"
                                                    style="height:50px;width:50px">
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>{{ $product->price }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- {{ $products->links() }} --}}
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
    <!-- /.content -->
@endsection
