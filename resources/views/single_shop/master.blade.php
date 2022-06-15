<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/images/icons/favicon.png">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('single_shop/css/bootstrap.min.css') }}">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('single_shop/css/demo5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('single_shop/vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('single_shop/vendor/simple-line-icons/css/simple-line-icons.min.css') }}">
    @yield('css')
</head>

<body class="bg-white">
    <div class="page-wrapper">
        <header class="header">
            <div class="header-middle sticky-header" data-sticky-options="{'mobile': true}" style="">
                <div class="container">
                    <div class="header-left col-lg-5 w-auto pl-0">
                        <a href="{{ route('shop.singleShopIndex', $shop->online_market_link) }}"
                            class="d-flex justify-content-start">
                            <img src="{{ asset($shop->image) }}" style="height: 70px;width:70px;" alt="Porto Logo">
                            <div>
                                <h4>{{ $shop->name }}</h4>
                                <p>{{ $shop->address }}</p>
                            </div>
                        </a>

                    </div>
                    <!-- End .header-left -->
                    <div class="header-right w-lg-max">

                        <div
                            class="header-icon header-icon header-search header-search-inline header-search-category w-lg-max ml-3 mr-xl-4">
                            <a href="#" class="search-toggle" role="button">
                                <i class="icon-search-3"></i>
                            </a>
                            <form action="#" method="get">
                                <div class="header-search-wrapper" style="float: right;">
                                    <input type="search" class="form-control " name="q" id="q" placeholder="Search..."
                                        required="" style="border: 1px solid;width:auto;">
                                    <button class="btn icon-magnifier" type="submit"></button>
                                </div>
                                <!-- End .header-search-wrapper -->
                            </form>
                        </div>
                        <!-- End .header-search -->
                        <div class="header-contact ml-auto pl-1  pr-xl-2" style="color: black">
                            <p><i class="fas fa-phone-volume m-0 p-0" style="font-size: 20px;"></i>{{ $shop->phone }}
                            </p>
                        </div>
                        <div class="dropdown cart-dropdown">
                            <a href="{{ route('shop.singleShopCart', $shop->online_market_link) }}" title="Cart"
                                class="d-flex justify-content-between removeBorder">
                                <p style="margin-top: auto;margin-right: 1rem;" class="d-none d-lg-flex">My Cart
                                    <br>(TK: {{ number_format(Cart::subtotal(), 2) }})
                                </p>
                                <div>
                                    <i class="minicart-icon" style="border: 1px solid #000000"></i>
                                    <span class="cart-count badge-circle total_cart_items">{{ Cart::count() }}</span>
                                </div>
                            </a>
                        </div>
                        <!-- End .dropdown -->
                    </div>
                    <!-- End .header-right -->
                </div>
                <!-- End .container -->
            </div>
            <!-- End .header-bottom -->
        </header>
        <!-- End .header -->
        <main class="main">
            <div class="container container-not-boxed">
                @yield('content')
            </div>
            <!-- End .container-not-boxed -->
        </main>
        <!-- End .main -->
        <footer class="footer">
            <div class="footer-middle" style="background-color: black;color: white;font-weight: 700;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="widget">
                                <h4 class="widget-title text-light">Customer Service</h4>
                                <div class="links link-parts row mb-0 ml-0 ml-0">
                                    <ul class="link-part">
                                        <li>
                                            <a href="demo5-about.html">About Us</a>
                                        </li>
                                        <li>
                                            <a href="demo5-contact.html">Contact Us</a>
                                        </li>
                                        <li>
                                            <a href="dashboard.html">My Account</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="widget">
                                <h4 class="widget-title text-light">Customer Service</h4>
                                <div class="links link-parts row mb-0 ml-0">
                                    <ul class="link-part">
                                        <li>
                                            <a href="demo5-about.html">About Us</a>
                                        </li>
                                        <li>
                                            <a href="demo5-contact.html">Contact Us</a>
                                        </li>
                                        <li>
                                            <a href="dashboard.html">My Account</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="widget">
                                <h4 class="widget-title text-light">Customer Service</h4>
                                <div class="links link-parts row mb-0 ml-0">
                                    <ul class="link-part">
                                        <li>
                                            <a href="demo5-about.html">About Us</a>
                                        </li>
                                        <li>
                                            <a href="demo5-contact.html">Contact Us</a>
                                        </li>
                                        <li>
                                            <a href="dashboard.html">My Account</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12 text-right">
                            <div class="widget">
                                <h4 class="widget-title text-light">Customer Service</h4>
                                <div class="row mb-0 mr-0" style="float: right;">
                                    <div class="social-icons">
                                        <a href="#" class="social-icon social-facebook icon-facebook" target="_blank"
                                            title="Facebook"></a>
                                        <a href="#" class="social-icon social-twitter icon-twitter" target="_blank"
                                            title="Twitter"></a>
                                        <a href="#" class="social-icon social-instagram icon-instagram" target="_blank"
                                            title="Instagram"></a>
                                    </div>
                                    <!-- End .social-icons -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End .row -->
                </div>
                <!-- End .container -->
            </div>
            <!-- End .footer-middle -->
            <div class="footer-bottom" style="background-color: #ffffff; font-weight: 600;">
                <div class="container d-flex justify-content-between align-items-center flex-wrap">
                    <p class="footer-copyright py-3 pr-4 mb-0 ls-n-10">© QuicktechIt eCommerce. 2022. All Rights
                        Reserved</p>
                    <img src="assets/images/demoes/demo5/payments.png" alt="payment methods"
                        class="footer-payments py-3">
                </div>
                <!-- End .container -->
            </div>
            <!-- End .footer-bottom -->
        </footer>
    </div>
    <!-- End .mobile-menu-container -->
    <a id="scroll-top" href="#top" title="Top" role="button">
        <i class="icon-angle-up"></i>
    </a>
    <!-- Plugins JS File -->
    <script src="{{ asset('single_shop/js/jquery.min.js') }}"></script>
    <script src="{{ asset('single_shop/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('single_shop/js/plugins.min.js') }}"></script>
    <script src="{{ asset('single_shop/js/map.js') }}"></script>
    <!-- Main JS File -->
    <script src="{{ asset('single_shop/js/main.min.js') }}"></script>
    @yield('js')
</body>

</html>
