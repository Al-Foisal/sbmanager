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
                    {{-- <ul class="navbar-nav mx-auto ms-xl-auto me-xl-0">
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
                    </ul> --}}
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
                    {{-- <ul class="navbar-nav">
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
                    </ul> --}}
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
    <!--contact us-->
    <section id="cantact" class="position-relative padding_bottom_half bglight">
        <div class="container whitebox padding_bottom_half">
            <div class="padding_top">
                <div class="row">
                    <div class="col-md-12 text-center wow fadeInUp mt-n3" data-wow-delay="300ms">
                        <div class="heading-title bottom25 darkcolor">
                            <h2 class="font-normal darkcolor"> Our Privecy Policy </h2>
                        </div>
                        {{-- <div class="col-md-6 offset-md-3 heading_space">
                            <p>{{ $company->about }}</p>
                        </div> --}}
                    </div>
                    <div class="col-md-12 col-sm-12 order-md-2 text-center text-md-start">
                        <div class="contact-meta pl-0 pl-sm-5 wow fadeInRight" data-wow-delay="300ms">
                            <div class="heading-title heading_small">
                                <h3 class="darkcolor font-normal">Privacy</h3>
                            </div>
                            <div class="my-3">
                               
                                    Your privacy is important to us. It is SMART BUSINESS AMNAGER‘s policy to respect your privacy regarding any information we may collect from you across our websites, www.sbmanager.store or www.sbmanager.store devliery  or www.sbmanager.store or www.sbmanager.store, and other sites/ mobile applications (iOS or Android) we own and operate.

                                    We only ask for personal information when we truly need it to provide a service to you. We collect it by fair and lawful means, with your knowledge and consent. We also let you know why we’re collecting it and how it will be used.
                                    
                                    We only retain collected information for as long as necessary to provide you with your requested service. What data we store, we’ll protect within commercially acceptable means to prevent loss and theft, as well as unauthorized access, disclosure, copying, use or modification.
                                    
                                    We don’t share any personally identifying information publicly or with third-parties, except when required to by law.
                                    
                                    Our website may link to external sites that are not operated by us. Please be aware that we have no control over the content and practices of these sites, and cannot accept responsibility or liability for their respective privacy policies.
                                    
                                    You are free to refuse our request for your personal information, with the understanding that we may be unable to provide you with some of your desired services.
                                    
                                    Your continued use of our website will be regarded as acceptance of our practices around privacy and personal information. If you have any questions about how we handle user data and personal information, feel free to contact us.
                                
                            </div>
                            
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
                            <li><a href="{{ route('home') }}" class="pagescroll">Home</a></li>
                            
                            <li><a href="{{ route('privecy') }}">Our Privecy</a></li>
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
