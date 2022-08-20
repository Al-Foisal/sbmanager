<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Smart Business Manager</title>
    <link href="images/favicon.ico" rel="icon">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/tooltipster.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/cubeportfolio.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/revolution/navigation.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/revolution/settings.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar-nav" data-bs-offset="75" class="offset-nav">
    <!--PreLoader-->
    {{-- <div class="loader">
        <div class="loader-inner">
            <div class="cssload-loader"></div>
        </div>
    </div> --}}
    <!--PreLoader Ends-->
    <!-- header -->
    <header class="site-header" id="header">
        <nav class="navbar navbar-expand-lg transparent-bg static-nav">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset($company->logo) }}" alt="logo" class="logo-default">
                    <img src="{{ asset($company->logo) }}" alt="logo" class="logo-scrolled">
                </a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav mx-auto ms-xl-auto me-xl-0">
                        <li class="nav-item">
                            <a class="nav-link active pagescroll" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pagescroll scrollupto" href="#feature">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pagescroll" href="#pricing">Our Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pagescroll" href="#faq">Our FAQ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pagescroll" href="#cantact">Contract Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('customer.login') }}">Web Login</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--side menu open button-->
            <a href="javascript:void(0)" class="d-inline-block sidemenu_btn" id="sidemenu_toggle">
                <span></span> <span></span> <span></span>
            </a>
        </nav>
        <!-- side menu -->
        <div class="side-menu opacity-0 gradient-bg">
            <div class="overlay"></div>
            <div class="inner-wrapper">
                <span class="btn-close btn-close-no-padding" id="btn_sideNavClose"><i></i><i></i></span>
                <nav class="side-nav w-100">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active pagescroll" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pagescroll scrollupto" href="#feature">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pagescroll" href="#pricing">Our Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pagescroll" href="#faq">FAQ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pagescroll" href="#cantact">Contract Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('customer.login') }}">Web Login</a>
                        </li>
                    </ul>
                </nav>
                <div class="side-footer w-100">
                    <ul class="social-icons-simple white top40">
                        @if ($company->facebook)
                            <li><a href="{{ $company->facebook }}" class="facebook"><i class="fab fa-facebook-f"></i>
                                </a> </li>
                        @endif
                        @if ($company->twitter)
                            <li><a href="{{ $company->twitter }}" class="twitter"><i class="fab fa-twitter"></i>
                                </a> </li>
                        @endif
                        @if ($company->linkedin)
                            <li><a href="{{ $company->linkedin }}" class="linkedin"><i class="fab fa-linkedin-in"></i>
                                </a> </li>
                        @endif
                        @if ($company->inatagram)
                            <li><a href="{{ $company->inatagram }}" class="insta"><i class="fab fa-instagram"></i>
                                </a> </li>
                        @endif
                        @if ($company->youtube)
                            <li><a href="{{ $company->youtube }}" class="whatsapp"><i class="fab fa-youtube"></i>
                                </a> </li>
                        @endif

                        @if ($company->pinterest)
                            <li><a href="{{ $company->pinterest }}" class="whatsapp"><i
                                        class="fab fa-pinterest"></i>
                                </a> </li>
                        @endif
                    </ul>
                    <p class="whitecolor">&copy; <span id="year"></span> Trax. Made With Love by Quicktech IT
                    </p>
                </div>
            </div>
        </div>
        <div id="close_side_menu" class="tooltip"></div>
        <!-- End side menu -->
    </header>
    <!-- header -->
    <!--Main Slider-->
    <section id="home" class="position-relative">
        <div id="revo_main_wrapper" class="rev_slider_wrapper fullwidthbanner-container m-0 p-0 bg-dark"
            data-alias="classic4export" data-source="gallery">
            <!-- START REVOLUTION SLIDER 5.4.1 fullwidth mode -->
            <div id="rev_creative" class="rev_slider fullwidthabanner white" data-version="5.4.1">
                <ul>
                    @foreach ($slider as $slid)
                        <li>
                            <!-- MAIN IMAGE -->
                            <div class="overlay overlay-dark opacity-5"></div>
                            <img src="{{ asset($slid->image) }}" alt="" data-bgposition="center center"
                                data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10"
                                class="rev-slidebg" data-no-retina>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
    <!--Main Slider ends -->
    <!--Some Feature -->
    <section id="feature" class="single-feature padding mt-n5">
        <div class="container">
            @foreach ($features as $key => $feature)
                @if ($key % 2)
                    <div class="row d-flex align-items-center mb-2">
                        <div class="col-lg-6 col-md-7 col-sm-7 text-sm-start text-center wow fadeInLeft"
                            data-wow-delay="300ms">
                            <div class="heading-title mb-4">
                                <h2 class="darkcolor font-normal bottom30">{{ $feature->name }}</h2>
                            </div>
                            <p class="bottom35">
                                {!! $feature->details !!}
                            </p>
                        </div>
                        <div class="col-lg-5 offset-lg-1 col-md-5 col-sm-5 wow fadeInRight" data-wow-delay="300ms">
                            <div class="image"><img alt="SEO" src="{{ asset($feature->image) }}"></div>
                        </div>
                    </div>
                @else
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-5 offset-lg-1 col-md-5 col-sm-5 wow fadeInRight" data-wow-delay="300ms">
                            <div class="image"><img alt="SEO" src="{{ asset($feature->image) }}"></div>
                        </div>
                        <div class="col-lg-6 col-md-7 col-sm-7 text-sm-start text-center wow fadeInLeft"
                            data-wow-delay="300ms">
                            <div class="heading-title mb-4">
                                <h2 class="darkcolor font-normal bottom30">{{ $feature->name }}</h2>
                            </div>
                            <p class="bottom35">
                                {!! $feature->details !!}
                            </p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
    <!--Some Feature ends-->

    <!--Pricing Start-->
    <section id="pricing" class="padding bglight">
        <div class="container">
            <div class="owl-carousel owl-theme no-dots" id="price-slider">
                @foreach ($packages as $package)
                    <div class="item">
                        <div class="col-md-12">
                            <div class="pricing-item wow fadeInUp animated @if ($key === 1) active selected @else @endif"
                                data-wow-delay="300ms">
                                {{-- sale data-sale="30" --}}
                                <h3 class="font-light darkcolor">{{ $package->name }}</h3>
                                <p class="bottom30">{{ $package->title }}</p>
                                <div class="pricing-price darkcolor"><span
                                        class="pricing-currency">${{ $package->amount }}</span>
                                    /<span class="pricing-duration">month</span></div>
                                <ul class="pricing-list">
                                    @foreach ($package->packageDetails as $details)
                                        <li>{{ $details->name }}</li>
                                    @endforeach
                                </ul>
                                <a class="button" href="javascript:void(0)">Choose plan</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--Pricing ends-->
    <section id="faq" class="single-feature padding mt-n5">
        <div class="container">
            @foreach ($faq as $key => $item)
                <div class="row d-flex align-items-center mb-5">
                    <div class="col-lg-12 col-md-12 col-sm-12 text-sm-start text-center wow fadeInLeft"
                        data-wow-delay="300ms">
                        <div class="heading-title mb-4">
                            <h2 class="darkcolor font-normal bottom30">{{ $item->name }}</h2>
                        </div>
                        @if ($item->video)
                            <video style="height: 400px;width:100%;" controls preload="auto" autoplay loop muted>
                                <source src="{{ asset($item->video) }}" type='video/mp4'>
                            </video>
                        @else
                            <p class="bottom35">
                                {!! $item->details !!}
                            </p>
                        @endif
                    </div>
                </div>
                {{-- @else
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-5 offset-lg-1 col-md-5 col-sm-5 wow fadeInRight" data-wow-delay="300ms">
                            <div class="image"><img alt="SEO" src="{{ asset($feature->image) }}"></div>
                        </div>
                        <div class="col-lg-6 col-md-7 col-sm-7 text-sm-start text-center wow fadeInLeft"
                            data-wow-delay="300ms">
                            <div class="heading-title mb-4">
                                <h2 class="darkcolor font-normal bottom30">{{ $feature->name }}</h2>
                            </div>
                            <p class="bottom35">
                                {!! $feature->details !!}
                            </p>
                        </div>
                    </div>
                @endif --}}
            @endforeach
        </div>
    </section>
    <!--Some Feature ends-->
    <!--contact us-->
    <section id="cantact" class="position-relative padding_bottom_half bglight">
        <div class="container whitebox padding_bottom_half">
            <div class="padding_top">
                <div class="row">
                    <div class="col-md-12 text-center wow fadeInUp mt-n3" data-wow-delay="300ms">
                        <div class="heading-title bottom25 darkcolor">
                            <h2 class="font-normal darkcolor"> Contact Us </h2>
                        </div>
                        <div class="col-md-6 offset-md-3 heading_space">
                            <p>{{ $company->about }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 order-md-2 text-center text-md-start">
                        <div class="contact-meta pl-0 pl-sm-5 wow fadeInRight" data-wow-delay="300ms">
                            <div class="heading-title heading_small">
                                <h3 class="darkcolor font-normal">{{ config('app.name') }}</h3>
                            </div>
                            <div class="my-3">
                                <p class="bottom10">
                                    {{ $company->address }}
                                </p>
                                <p class="bottom10">{{ $company->phone_one }}</p>
                                <p class="bottom10">{{ $company->phone_two }}</p>
                                <p class="bottom10">{{ $company->phone_three }}</p>
                                <p class="bottom10"><a href="mailto:{{ $company->email }}">{{ $company->email }}</a>
                                </p>
                            </div>
                            <ul class="social-icons no-border mb-4 mb-md-0 wow fadeInUp" data-wow-delay="300ms">
                                @if ($company->facebook)
                                    <li><a href="{{ $company->facebook }}" class="facebook"><i
                                                class="fab fa-facebook-f"></i>
                                        </a> </li>
                                @endif
                                @if ($company->twitter)
                                    <li><a href="{{ $company->twitter }}" class="twitter"><i
                                                class="fab fa-twitter"></i>
                                        </a> </li>
                                @endif
                                @if ($company->linkedin)
                                    <li><a href="{{ $company->linkedin }}" class="linkedin"><i
                                                class="fab fa-linkedin-in"></i>
                                        </a> </li>
                                @endif
                                @if ($company->inatagram)
                                    <li><a href="{{ $company->inatagram }}" class="insta"><i
                                                class="fab fa-instagram"></i>
                                        </a> </li>
                                @endif
                                @if ($company->youtube)
                                    <li><a href="{{ $company->youtube }}" class="whatsapp"><i
                                                class="fab fa-youtube"></i>
                                        </a> </li>
                                @endif

                                @if ($company->pinterest)
                                    <li><a href="{{ $company->pinterest }}" class="whatsapp"><i
                                                class="fab fa-pinterest"></i>
                                        </a> </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="heading-title  wow fadeInLeft" data-wow-delay="300ms">
                            <form class="getin_form" action="{{ route('submitContact') }}" method="post">
                                @csrf
                                <div class="row px-2">
                                    <div class="col-md-12 col-sm-12" id=""></div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="name1" class="d-none"></label>
                                            <input class="form-control" id="name1" type="text"
                                                placeholder="Name" required="" name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="email1" class="d-none"></label>
                                            <input class="form-control" type="email" id="email1"
                                                placeholder="Email" name="email">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="phone" class="d-none"></label>
                                            <input class="form-control" type="text" id="phone"
                                                placeholder="Phone" name="phone">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="subject" class="d-none"></label>
                                            <input class="form-control" type="text" id="subject"
                                                placeholder="Subject" name="subject">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="message1" class="d-none"></label>
                                            <textarea class="form-control" id="message1" placeholder="Message" required="" name="message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <button type="submit" id="submit_btn1"
                                            class="button gradient-btn w-100">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--contact us end-->
    <!--Site Footer Here-->
    <footer id="site-footer" class=" bgdark padding_top">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="footer_panel padding_bottom_half bottom20">
                        <a href="{{ route('home') }}" class="footer_logo bottom25"><img
                                src="{{ asset($company->logo) }}" alt="trax"></a>
                        <p class="whitecolor bottom25">
                            {{ $company->about }}
                        </p>
                        <div class="d-table w-100 address-item whitecolor bottom25">
                            <span class="d-table-cell align-middle"><i class="fas fa-mobile-alt"></i></span>
                            <p class="d-table-cell align-middle bottom0">
                                {{ $company->phone_one }} <br>
                                {{ $company->phone_two }} <br>
                                {{ $company->phone_three }} <br>
                                <a class="d-block" href="mailto:{{ $company->email }}">{{ $company->email }}</a>
                            </p>
                        </div>
                        <ul class="social-icons white wow fadeInUp" data-wow-delay="300ms">
                            @if ($company->facebook)
                                <li><a href="{{ $company->facebook }}" class="facebook"><i
                                            class="fab fa-facebook-f"></i>
                                    </a> </li>
                            @endif
                            @if ($company->twitter)
                                <li><a href="{{ $company->twitter }}" class="twitter"><i class="fab fa-twitter"></i>
                                    </a> </li>
                            @endif
                            @if ($company->linkedin)
                                <li><a href="{{ $company->linkedin }}" class="linkedin"><i
                                            class="fab fa-linkedin-in"></i>
                                    </a> </li>
                            @endif
                            @if ($company->inatagram)
                                <li><a href="{{ $company->inatagram }}" class="insta"><i
                                            class="fab fa-instagram"></i>
                                    </a> </li>
                            @endif
                            @if ($company->youtube)
                                <li><a href="{{ $company->youtube }}" class="whatsapp"><i
                                            class="fab fa-youtube"></i>
                                    </a> </li>
                            @endif

                            @if ($company->pinterest)
                                <li><a href="{{ $company->pinterest }}" class="whatsapp"><i
                                            class="fab fa-pinterest"></i>
                                    </a> </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="footer_panel padding_bottom_half bottom20 ps-0 ps-lg-5">
                        <h3 class="whitecolor bottom25">Navigation</h3>
                        <ul class="links">
                            <li><a href="#home" class="pagescroll">Home</a></li>
                            <li><a href="#feature" class="pagescroll scrollupto">Our Feature</a></li>
                            <li><a href="#pricing" class="pagescroll">Our Pricing</a></li>
                            <li><a href="#cantact" class="pagescroll">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--Footer ends-->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
    <!--Bootstrap Core-->
    <script src="{{ asset('frontend/js/propper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <!--to view items on reach-->
    <script src="{{ asset('frontend/js/jquery.appear.js') }}"></script>
    <!--Owl Slider-->
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <!--number counters-->
    <script src="{{ asset('frontend/js/jquery-countTo.js') }}"></script>
    <!--Parallax Background-->
    <script src="{{ asset('frontend/js/parallaxie.js') }}"></script>
    <!--Cubefolio Gallery-->
    <script src="{{ asset('frontend/js/jquery.cubeportfolio.min.js') }}"></script>
    <!--Fancybox js-->
    <script src="{{ asset('frontend/js/jquery.fancybox.min.js') }}"></script>
    <!--Tooltip js-->
    <script src="{{ asset('frontend/js/tooltipster.min.js') }}"></script>
    <!--wow js-->
    <script src="{{ asset('frontend/js/wow.js') }}"></script>
    <!--Revolution SLider-->
    <script src="{{ asset('frontend/js/revolution/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('frontend/js/revolution/jquery.themepunch.revolution.min.js') }}"></script>
    <!-- SLIDER REVOLUTION 5.0 EXTENSIONS -->
    <script src="{{ asset('frontend/js/revolution/extensions/revolution.extension.actions.min.js') }}"></script>
    <script src="{{ asset('frontend/js/revolution/extensions/revolution.extension.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/revolution/extensions/revolution.extension.kenburn.min.js') }}"></script>
    <script src="{{ asset('frontend/js/revolution/extensions/revolution.extension.layeranimation.min.js') }}"></script>
    <script src="{{ asset('frontend/js/revolution/extensions/revolution.extension.migration.min.js') }}"></script>
    <script src="{{ asset('frontend/js/revolution/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script src="{{ asset('frontend/js/revolution/extensions/revolution.extension.parallax.min.js') }}"></script>
    <script src="{{ asset('frontend/js/revolution/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <script src="{{ asset('frontend/js/revolution/extensions/revolution.extension.video.min.js') }}"></script>
    <!--map js-->
    <!--custom functions and script-->
    <script src="{{ asset('frontend/js/functions.js') }}"></script>
</body>

<!-- Mirrored from trax.acrothemes.com/bootstrap-v5/single-index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 18 Jun 2022 06:10:40 GMT -->

</html>
