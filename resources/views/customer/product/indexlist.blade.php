@extends('customer.layouts.master')
@section('title', 'Product list')

@section('backend')
    <!-- Main content -->
    <section class="content mmm">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-12 form-inline">
                    <div class="form-group" style="width: 91%;margin-right:5%;">
                        <input type="text" name="name" id="name" class="form-control"
                            placeholder="Enter product name" style="width: 100%" />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-angle-down"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive" style="height: 430px;">

                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Sell Now</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @include('customer.product.product_search_paginate')
                                </tbody>
                            </table>
                            <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                        </div>
                        <tfoot>
                            <tr>
                                <a href="{{ route('customer.cart') }}" class="btn btn-info btn-sm">
                                    <h6 style="width: 50%;text-align:left;float:left;">Total Sale</h6>
                                    <div class="d-flex justify-content-start mr-3"
                                        style="width: 10%;text-align:left;float:left;">
                                        <p>৳</p>
                                        <p class="total_cart_subtotal">
                                            {{ Cart::subtotal() }}</p>
                                    </div>
                                    <div class="d-flex justify-content-start bg-white" style="width: 5%;float:left;">
                                        <p class="total_cart_items" style="text-align:center;">
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Category List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul>
                        @foreach ($subcategory as $sub)
                            <li>
                                <a
                                    href="{{ route('customer.products.index.list', ['id' => $sub->id]) }}">{{ $sub->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jsScript')
    <script>
        function add_to_cart(product_id) {
            $(document).ready(function(e) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: 'POST',
                    url: "{{ asset('/') }}customer/add-to-cart",
                    data: {
                        id: product_id,
                    },
                    cache: false,
                    success: function(response) {
                        //  window.location.reload();
                        if (response.status === 'success') {
                            Toast.fire({
                                icon: 'success',
                                title: 'Product added to cart successfully'
                            })
                            $('.total_cart_items').html(response.cart_count);
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'Product out of stock'
                            })
                        }
                        $('.total_cart_items').html(response.cart_count);
                        $('.total_cart_subtotal').html(response.cart_subtotal);
                    },
                    async: false,
                    error: function(error) {}
                })
            })
        }
    </script>

    <script>
        $(document).ready(function() {

            function fetch_data(page, name) {
                $.ajax({
                    url: "/customer/product/list/fetch_data?page=" + page + "&name=" + name,
                    success: function(data) {
                        $('tbody').html('');
                        $('tbody').html(data);
                    }
                })
            }

            $(document).on('keyup', '#name', function() {
                var name = $('#name').val();
                var page = $('#hidden_page').val();
                fetch_data(page, name);
            });
        });
    </script>
@endsection
