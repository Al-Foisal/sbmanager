@extends('customer.layouts.master')
@section('title', 'Product list')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header mmm">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Buy product from your shop product list</h1>
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
                        <div class="card-body table-responsive" style="height: 400px;">

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Buying Price</th>
                                        <th>Selling Price</th>
                                        <th>Sell Now</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>
                                                <img src="{{ asset($product->image === null ? 'images/user.png' : $product->image) }}"
                                                    style="height:50px;width:50px">
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>{{ $product->buying_price }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>
                                                <a onclick="add_to_cart({{ $product->id }})"
                                                    class="btn btn-success btn-sm">Add to Cart</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- {{ $products->links() }} --}}
                        </div>
                        <tfoot>
                            <tr>
                                <a href="{{ route('customer.buy.cart') }}" class="btn btn-info btn-sm">
                                    <h6 style="width: 50%;text-align:left;float:left;">Total Sale</h6>
                                    <div class="d-flex justify-content-start mr-3"
                                        style="width: 10%;text-align:left;float:left;">
                                        <p>৳</p>
                                        <p class="total_cart_subtotal">
                                            {{ Cart::subtotal() }}</p>
                                    </div>
                                    <div class="d-flex justify-content-start bg-white"
                                        style="width: 5%;float:left;">
                                        <p class="total_cart_items" 
                                        style="text-align:center;">
                                            {{ Cart::count() }}</p>
                                        <p>></p>
                                    </div>
                                </a>
                            </tr>
                        </tfoot>
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
@section('jsScript')
    <script>
        function add_to_cart(product_id) {
            $(document).ready(function(e) {
                // const Toast = Swal.mixin({
                //     toast: true,
                //     position: 'top-end',
                //     showConfirmButton: false,
                //     timer: 3000,
                //     timerProgressBar: true,
                //     didOpen: (toast) => {
                //         toast.addEventListener('mouseenter', Swal.stopTimer)
                //         toast.addEventListener('mouseleave', Swal.resumeTimer)
                //     }
                // })
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: 'POST',
                    url: "{{ asset('/') }}customer/buy/add-to-cart",
                    data: {
                        id: product_id,
                    },
                    cache: false,
                    success: function(response) {
                        //  window.location.reload();
                        if (response.status === 'success') {
                            // Toast.fire({
                            //     icon: 'success',
                            //     title: 'Product added to cart successfully'
                            // })
                            $('.total_cart_items').html(response.cart_count);
                        } else {
                            // Toast.fire({
                            //     icon: 'error',
                            //     title: 'Product out of stock'
                            // })
                        }
                        $('.total_cart_items').html(response.cart_count);
                        $('.total_cart_subtotal').html(response.cart_subtotal);
                    },
                    async: false,
                    error: function(error) {
                    }
                })
            })
        }
    </script>
@endsection