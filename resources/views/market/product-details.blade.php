@extends('market.master')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-6 mt-3 mb-3">
                        <img src="{{ asset($product->image) }}" style="height:100%;width:100%;">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $product->name }}
                            </h5>
                            <p class="card-text">
                                {!! $product->details !!}
                            </p>
                            <p class="card-text">
                                <b>TK: </b>{{ $product->price }}
                            </p>
                            <div class="d-grid gap-2">
                                <button class="btn btn-info" onclick="add_to_cart({{ $product->id }})">Book
                                    Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery -->
    <script src="{{ asset('backend/js/jquery.min.js') }}"></script>

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
