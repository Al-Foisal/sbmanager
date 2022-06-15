@extends('customer.layouts.master')
@section('title', SHOP()->name)
@section('cssStyle')
    <style>
        .social-btn-sp #social-links {
            margin: 0 auto;
            max-width: 500px;
        }

        .social-btn-sp #social-links ul li {
            display: inline-block;
        }

        .social-btn-sp #social-links ul li a {
            padding: 15px;
            border: 1px solid #ccc;
            margin: 1px;
            font-size: 30px;
        }

        table #social-links {
            display: inline-table;
        }

        table #social-links ul li {
            display: inline;
        }

        table #social-links ul li a {
            padding: 5px;
            border: 1px solid #ccc;
            margin: 1px;
            font-size: 15px;
            background: #e3e3ea;
        }
    </style>
@endsection
@section('backend')
    <section class="content-header mmm">
        <div class="container-fluid">
            <div class="card">
                <div class="p-3 mb-5">
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-light btn-sm mr-3" style="border:1px solid; padding:1% 10% 1% 10%;margin-top:2%;"
                            href="{{ route('shop.singleShopIndex', SHOP()->online_market_link) }}" target="_blank">Visite Your Site</a>
                        <button class="btn btn-light btn-sm" style="border:1px solid; padding:1% 10% 1% 10%;margin-top:2%;"
                            data-toggle="modal" data-target="#shareLink">Share Your
                            Link</button>
                    </div>
                </div>
                <div class="mb-5 d-flex justify-content-around">
                    <div class="text-center bg-primary rounded" style="    padding: 2% 10% 1% 10%;">
                        <h6>Active Order</h6>
                        <p>{{ $active_order }}</p>
                    </div>
                    <div class="text-center bg-primary rounded" style="    padding: 2% 10% 1% 10%;">
                        <h6>Online Product</h6>
                        <p>{{ $online_product }}</p>
                    </div>
                    <div class="text-center bg-primary rounded" style="    padding: 2% 10% 1% 10%;">
                        <h6>Earned</h6>
                        <p>TK: {{ number_format($earn,2) }}</p>
                    </div>
                </div>
                <div class="mb-5 d-flex justify-content-around">
                    <a href="{{ route('customer.shop.orderList') }}" class="text-center btn btn-light rounded"
                        style="padding: 1% 4% 1% 5%;;border: 1px solid;">
                        <img src="{{ asset('images/order-list.svg') }}" alt="">
                        <h6>Order List</h6>
                    </a>
                    <a href="{{ route('customer.shop.onlineOrderList') }}" class="text-center btn btn-light rounded"
                        style="padding: 1% 4% 1% 5%;;border: 1px solid;">
                        <img src="{{ asset('images/order-list.svg') }}" alt="">
                        <h6>Online Order List</h6>
                    </a>
                    <a href="{{ route('customer.shop.onlineProduct') }}" class="text-center btn btn-light rounded"
                        style="padding: 1% 3% 1% 4%;;border: 1px solid;">
                        <img src="{{ asset('images/online-product.svg') }}" alt="">
                        <h6>Online Product</h6>
                    </a>
                    <a href="{{ route('customer.shop.editStore') }}" class="text-center btn btn-light rounded"
                        style="padding: 1% 4% 1% 4%;;border: 1px solid;">
                        <img src="{{ asset('images/online-shop-setting.svg') }}" alt="">
                        <h6>Store Setting</h6>
                    </a>
                    <a class="text-center btn btn-light rounded" style="padding: 1% 3% 1% 4%;;border: 1px solid;">
                        <img src="{{ asset('images/online_message.svg') }}" alt="">
                        <h6>Online Message</h6>
                    </a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="modal fade" id="shareLink" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Share Your Link</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="social-btn-sp mt-3">
                        {!! $socialShare !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jsScript')

    <script></script>
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        var copyTextareaBtn = document.querySelector('.js-textareacopybtn');

        copyTextareaBtn.addEventListener('click', function(event) {
            var copyTextarea = document.querySelector('.js-copytextarea');
            copyTextarea.focus();
            copyTextarea.select();

            try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'successful' : 'unsuccessful';
                Toast.fire({
                    icon: 'success',
                    title: 'Payment link copyed.'
                })
            } catch (err) {
                Toast.fire({
                    icon: 'error',
                    title: 'Payment link copyed.'
                })
            }
        });

        function copyToClipboard(text) {
            const elem = document.createElement('textarea');
            elem.value = text;
            document.body.appendChild(elem);
            elem.select();
            document.execCommand('copy');

            Toast.fire({
                icon: 'success',
                title: 'Payment link copyed.'
            })
        }
    </script>

    {{-- submenu dependency --}}
    <script type="text/javascript">
        $(".js-example-tags").select2({
            tags: true
        });
    </script>
@endsection
