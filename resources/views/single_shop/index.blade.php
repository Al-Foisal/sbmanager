@extends('single_shop.master')
@section('title', '')
@section('css')
@endsection
@section('content')
    <div class="home-slider outer-container w-auto owl-carousel owl-theme owl-carousel-lazy show-nav-hover nav-large nav-outer mb-2"
        data-owl-options="{
                                                'loop': true,
                                                'dots': false,
                                                'nav': true,
                                                'autoplay': true
                                                }">
        @foreach ($slider as $slid)
            <div class="home-slide1">
                <a href="">
                    <img class="slide-bg" src="{{ asset($slid->image) }}" alt="slider image">
                </a>
            </div>
        @endforeach
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 main-content">
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-6 col-sm-4 col-md-3">
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                    <a
                                        href="{{ route('shop.singleShopDetails', [$shop->online_market_link, $product->slug]) }}">
                                        <img src="{{ asset($product->image) }}" width="212" height="212" alt="product" />
                                    </a>
                                </figure>
                                <div class="product-details">
                                    <h3 class="product-title">
                                        <a
                                            href="{{ route('shop.singleShopDetails', [$shop->online_market_link, $product->slug]) }}">{{ $product->name }}</a>
                                    </h3>

                                    <!-- End .product-container -->
                                    <div class="price-box">
                                        <span class="product-price">${{ number_format($product->price) }}</span>
                                    </div>
                                    <!-- End .price-box -->
                                </div>
                                <!-- End .product-details -->
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
