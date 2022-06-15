@extends('single_shop.master')
@section('content')
    <main class="main">
        <div class="container">
            <div class="product-single-container product-single-default">
                <div class="row">
                    <div class="col-lg-5 col-md-6 product-single-gallery">
                        <div class="product-slider-container">
                            <div class="product-single- ">
                                <div class="product-item">
                                    <img class="product-single-image" src="{{ asset($product->image) }}"
                                        data-zoom-image="assets/cp1.jpg" width="468" height="468" alt="product">
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- End .product-single-gallery -->
                    <div class="col-lg-7 col-md-6 product-single-details">
                        <h1 class="product-title">{{ $product->name }}</h1>
                        <br>
                        <div class="product-desc">
                            <strong>Product Details:</strong>
                            <br>
                            {!! $product->details !!}
                        </div>
                        <!-- End .product-desc -->
                        <div class="price-box">
                            <span class="new-price">TK: {{ number_format($product->price, 2) }}</span>
                        </div>
                        <!-- End .price-box -->
                        <br>
                        <div class="product-action" style="border: 0;">
                            <a href="javascript:;" onclick="add_to_cart({{ $product->id }})" class="btn btn-dark add-cart mr-2" title="Add to Cart">
                                Add to
                                Cart
                            </a>
                        </div>
                        <!-- End .product-action -->
                    </div>
                    <!-- End .product-single-details -->
                </div>
                <!-- End .row -->
            </div>
            <!-- End .product-single-container -->
        </div>
        <!-- End .container -->
    </main>

    <script>
        function add_to_cart(product_id) {
            console.log(product_id)
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

                    url: "{{ asset('/') }}add-to-cart",
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
                    error: function(error) {

                    }
                })
            })

        }
    </script>
@endsection
