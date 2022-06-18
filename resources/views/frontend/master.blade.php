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
    <div class="loader">
        <div class="loader-inner">
            <div class="cssload-loader"></div>
        </div>
    </div>
    <!--PreLoader Ends-->
    <!-- header -->
    <header class="site-header" id="header">
        <nav class="navbar navbar-expand-lg transparent-bg static-nav">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    <img src="images/logo-transparent.png" alt="logo" class="logo-default">
                    <img src="images/logo.png" alt="logo" class="logo-scrolled">
                </a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav mx-auto ms-xl-auto me-xl-0">
                        <li class="nav-item">
                            <a class="nav-link active pagescroll" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pagescroll scrollupto" href="#about">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pagescroll" href="#pricing">Our Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pagescroll" href="#portfolio">Portfolio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pagescroll" href="#blog">Our Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pagescroll" href="#contact">Contact Us</a>
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
                            <a class="nav-link  pagescroll" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pagescroll scrollupto" href="#about">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pagescroll" href="#pricing">Our Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pagescroll" href="#portfolio">Portfolio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pagescroll" href="#blog">Our Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pagescroll" href="#contact">Contact Us</a>
                        </li>
                    </ul>
                </nav>
                <div class="side-footer w-100">
                    <ul class="social-icons-simple white top40">
                        <li><a href="javascript:void(0)" class="facebook"><i class="fab fa-facebook-f"></i> </a> </li>
                        <li><a href="javascript:void(0)" class="twitter"><i class="fab fa-twitter"></i> </a> </li>
                        <li><a href="javascript:void(0)" class="insta"><i class="fab fa-instagram"></i> </a> </li>
                    </ul>
                    <p class="whitecolor">&copy; <span id="year"></span> Trax. Made With Love by ThemesIndustry
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
            <div id="rev_main" class="rev_slider fullwidthabanner white" data-version="5.4.1">
                <ul>
                    <!-- SLIDE 1 -->
                    <li data-index="rs-01" data-transition="fade" data-slotamount="default"
                        data-easein="Power100.easeIn" data-easeout="Power100.easeOut" data-masterspeed="2000"
                        data-fsmasterspeed="1500" data-param1="01">
                        <!-- MAIN IMAGE -->
                        <img src="images/banner1-4.jpg" alt="" data-bgposition="center center"
                            data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg"
                            data-no-retina>
                        <div class="overlay overlay-dark opacity-6"></div>
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption tp-resizeme" data-x="['center','center','center','center']"
                            data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                            data-voffset="['-130','-130','-110','-80']" data-width="none" data-height="none"
                            data-type="text" data-textAlign="['center','center','center','center']"
                            data-responsive_offset="on" data-start="1000"
                            data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","speed":2000,"to":"o:1;","delay":1500,"ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'>
                            <h1 class="text-capitalize font-xlight whitecolor text-center">The Ultimate</h1>
                        </div>
                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption tp-resizeme" data-x="['center','center','center','center']"
                            data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                            data-voffset="['-70','-70','-50','-20']" data-width="none" data-height="none"
                            data-type="text" data-textAlign="['center','center','center','center']"
                            data-responsive_offset="on" data-start="1000"
                            data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","speed":2000,"to":"o:1;","delay":1500,"ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'>
                            <h1 class="text-capitalize font-bold whitecolor text-center">Creative Business</h1>
                        </div>
                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption tp-resizeme" data-x="['center','center','center','center']"
                            data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                            data-voffset="['-10','-10','10','40']" data-width="none" data-height="none"
                            data-type="text" data-textAlign="['center','center','center','center']"
                            data-responsive_offset="on" data-start="1500"
                            data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","speed":2000,"to":"o:1;","delay":1500,"ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'>
                            <h1 class="text-capitalize font-xlight whitecolor text-center">In Market</h1>
                        </div>
                        <!-- LAYER NR. 4 -->
                        <div class="tp-caption tp-resizeme" data-x="['center','center','center','center']"
                            data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                            data-voffset="['40','40','60','90']" data-width="none" data-height="none"
                            data-whitespace="nowrap" data-type="text"
                            data-textAlign="['center','center','center','center']" data-responsive_offset="on"
                            data-start="2000"
                            data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":2000,"ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'>
                            <h4 class="whitecolor font-xlight text-center">The Best Multipurpose Multi Page Template in
                                Market</h4>
                        </div>
                    </li>
                    <!-- SLIDE 2 -->
                    <li data-index="rs-02" data-transition="fade" data-slotamount="default"
                        data-easein="Power3.easeInOut" data-easeout="Power3.easeInOut" data-masterspeed="2000"
                        data-fsmasterspeed="1500" data-param1="02">
                        <!-- MAIN IMAGE -->
                        <img src="images/banner1-5.jpg" alt="" data-bgposition="center center"
                            data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg"
                            data-no-retina>
                        <div class="overlay overlay-dark opacity-6"></div>
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption tp-resizeme" data-x="['center','center','center','center']"
                            data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                            data-voffset="['-130','-130','-110','-80']" data-width="none" data-height="none"
                            data-type="text" data-textAlign="['center','center','center','center']"
                            data-responsive_offset="on" data-start="1000"
                            data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","speed":2000,"to":"o:1;","delay":1500,"ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'>
                            <h1 class="text-capitalize font-xlight whitecolor text-center">Let's Create</h1>
                        </div>
                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption tp-resizeme" data-x="['center','center','center','center']"
                            data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                            data-voffset="['-70','-70','-50','-20']" data-width="none" data-height="none"
                            data-type="text" data-textAlign="['center','center','center','center']"
                            data-responsive_offset="on" data-start="1000"
                            data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","speed":2000,"to":"o:1;","delay":1500,"ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'>
                            <h1 class="text-capitalize font-bold whitecolor text-center">Deep Creativity</h1>
                        </div>
                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption tp-resizeme" data-x="['center','center','center','center']"
                            data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                            data-voffset="['-10','-10','10','40']" data-width="none" data-height="none"
                            data-type="text" data-textAlign="['center','center','center','center']"
                            data-responsive_offset="on" data-start="1500"
                            data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","speed":2000,"to":"o:1;","delay":1500,"ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'>
                            <h1 class="text-capitalize font-xlight whitecolor text-center">In Market</h1>
                        </div>
                        <!-- LAYER NR. 4 -->
                        <div class="tp-caption tp-resizeme" data-x="['center','center','center','center']"
                            data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                            data-voffset="['40','40','60','90']" data-width="none" data-height="none"
                            data-whitespace="nowrap" data-type="text"
                            data-textAlign="['center','center','center','center']" data-responsive_offset="on"
                            data-start="2000"
                            data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":2000,"ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'>
                            <h4 class="whitecolor font-xlight text-center">Responsive and Retina Ready for All Devices
                            </h4>
                        </div>
                    </li>
                    <!-- SLIDE 3 -->
                    <li data-index="rs-03" data-transition="fade" data-slotamount="default"
                        data-easein="Power3.easeInOut" data-easeout="Power3.easeInOut" data-masterspeed="2000"
                        data-fsmasterspeed="1500" data-param1="03">
                        <!-- MAIN IMAGE -->
                        <img src="images/banner1-6.jpg" alt="" data-bgposition="center center"
                            data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg"
                            data-no-retina>
                        <div class="overlay overlay-dark opacity-7"></div>
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption tp-resizeme" data-x="['center','center','center','center']"
                            data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                            data-voffset="['-130','-130','-110','-80']" data-width="none" data-height="none"
                            data-type="text" data-textAlign="['center','center','center','center']"
                            data-responsive_offset="on" data-start="1000"
                            data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","speed":2000,"to":"o:1;","delay":1500,"ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'>
                            <h1 class="text-capitalize font-xlight whitecolor text-center">We Make</h1>
                        </div>
                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption tp-resizeme" data-x="['center','center','center','center']"
                            data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                            data-voffset="['-70','-70','-50','-20']" data-width="none" data-height="none"
                            data-type="text" data-textAlign="['center','center','center','center']"
                            data-responsive_offset="on" data-start="1000"
                            data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","speed":2000,"to":"o:1;","delay":1500,"ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'>
                            <h1 class="text-capitalize font-bold whitecolor text-center">Inspired Design</h1>
                        </div>
                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption tp-resizeme" data-x="['center','center','center','center']"
                            data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                            data-voffset="['-10','-10','10','40']" data-width="none" data-height="none"
                            data-type="text" data-textAlign="['center','center','center','center']"
                            data-responsive_offset="on" data-start="1500"
                            data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","speed":2000,"to":"o:1;","delay":1500,"ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'>
                            <h1 class="text-capitalize font-xlight whitecolor text-center">Our Trax</h1>
                        </div>
                        <!-- LAYER NR. 4 -->
                        <div class="tp-caption tp-resizeme" data-x="['center','center','center','center']"
                            data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                            data-voffset="['40','40','60','90']" data-width="none" data-height="none"
                            data-whitespace="nowrap" data-type="text"
                            data-textAlign="['center','center','center','center']" data-responsive_offset="on"
                            data-start="2000"
                            data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":2000,"ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'>
                            <h4 class="whitecolor font-xlight text-center">Is a New Design Studio founded in NewYork
                            </h4>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <ul class="social-icons-simple revicon white">
            <li class="d-table"><a href="javascript:void(0)" class="facebook"><i class="fab fa-facebook-f"></i></a>
            </li>
            <li class="d-table"><a href="javascript:void(0)" class="twitter"><i class="fab fa-twitter"></i> </a>
            </li>
            <li class="d-table"><a href="javascript:void(0)" class="linkedin"><i class="fab fa-linkedin-in"></i>
                </a> </li>
            <li class="d-table"><a href="javascript:void(0)" class="insta"><i class="fab fa-instagram"></i> </a>
            </li>
        </ul>
    </section>
    <!--Main Slider ends -->
    <!--Some Services-->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="services-slider" class="owl-carousel">
                    <div class="item">
                        <div class="service-box">
                            <span class="bottom25"><i class="fa fa-clipboard"></i></span>
                            <h4 class="bottom10 text-nowrap"><a href="javascript:void(0)">Well Documented</a></h4>
                            <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="service-box">
                            <span class="bottom25"><i class="fa fa-laptop"></i></span>
                            <h4 class="bottom10"><a href="javascript:void(0)">Fully Responsive</a></h4>
                            <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="service-box">
                            <span class="bottom25"><i class="fa fa-globe"></i></span>
                            <h4 class="bottom10"><a href="javascript:void(0)">Full Support</a></h4>
                            <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="service-box">
                            <span class="bottom25"><i class="fa fa-edit"></i></span>
                            <h4 class="bottom10"><a href="javascript:void(0)">Clean Coded</a></h4>
                            <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="service-box">
                            <span class="bottom25"><i class="fa fa-globe"></i></span>
                            <h4 class="bottom10"><a href="javascript:void(0)">SEO Optimized</a></h4>
                            <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Some Services ends-->
    <!--Some Feature -->
    <section id="about" class="single-feature padding mt-n5">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-6 col-md-7 col-sm-7 text-sm-start text-center wow fadeInLeft"
                    data-wow-delay="300ms">
                    <div class="heading-title mb-4">
                        <h2 class="darkcolor font-normal bottom30">Lets take your <span
                                class="defaultcolor">Business</span> to Next Level</h2>
                    </div>
                    <p class="bottom35">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mauris arcu,
                        lobortis id interdum vitae, interdum eget elit. Curabitur quis urna nulla. Suspendisse potenti.
                        Duis suscipit ultrices maximus. </p>
                    <a href="javascript:void(0)" class="button gradient-btn mb-sm-0 mb-4">Learn More</a>
                </div>
                <div class="col-lg-5 offset-lg-1 col-md-5 col-sm-5 wow fadeInRight" data-wow-delay="300ms">
                    <div class="image"><img alt="SEO" src="images/awesome-feature.png"></div>
                </div>
            </div>
        </div>
    </section>
    <!--Some Feature ends-->
    <!-- WOrk Process-->
    <section id="our-process" class="padding bgdark">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 text-center">
                    <div class="heading-title whitecolor wow fadeInUp" data-wow-delay="300ms">
                        <span>Quisque tellus risus, adipisci </span>
                        <h2 class="font-normal">Our Work Process </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <ul class="process-wrapp">
                    <li class="whitecolor wow fadeIn" data-wow-delay="300ms">
                        <span class="pro-step bottom20">01</span>
                        <p class="fontbold bottom20">Concept</p>
                        <p class="mt-n2 mt-sm-0">Quisque tellus risus, adipisci viverra bibendum urna.</p>
                    </li>
                    <li class="whitecolor wow fadeIn" data-wow-delay="400ms">
                        <span class="pro-step bottom20">02</span>
                        <p class="fontbold bottom20">Plan</p>
                        <p class="mt-n2 mt-sm-0">Quisque tellus risus, adipisci viverra bibendum urna.</p>
                    </li>
                    <li class="whitecolor wow fadeIn active" data-wow-delay="500ms">
                        <span class="pro-step bottom20">03</span>
                        <p class="fontbold bottom20">Design</p>
                        <p class="mt-n2 mt-sm-0">Quisque tellus risus, adipisci viverra bibendum urna.</p>
                    </li>
                    <li class="whitecolor wow fadeIn" data-wow-delay="600ms">
                        <span class="pro-step bottom20">04</span>
                        <p class="fontbold bottom20">Development</p>
                        <p class="mt-n2 mt-sm-0">Quisque tellus risus, adipisci viverra bibendum urna.</p>
                    </li>
                    <li class="whitecolor wow fadeIn" data-wow-delay="700ms">
                        <span class="pro-step bottom20">05</span>
                        <p class="fontbold bottom20">Quality Check</p>
                        <p class="mt-n2 mt-sm-0">Quisque tellus risus, adipisci viverra bibendum urna.</p>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!--WOrk Process ends-->
    <!-- Mobile Apps -->
    <section id="our-apps" class="padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-7 col-sm-12">
                    <div class="heading-title bottom30 wow fadeInUp" data-wow-delay="300ms">
                        <span class="defaultcolor text-center text-md-start">Quisque tellus risus, adipisci
                            viverra</span>
                        <h2 class="darkcolor font-normal text-center text-md-start">Mobile App Designs</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5 col-sm-12">
                    <p class="text-center text-md-start">Curabitur mollis bibendum luctus. Duis suscipit vitae dui sed
                        suscipit. Vestibulum auctor nunc vitae diam eleifend, in maximus metus sollicitudin. Quisque
                        vitae sodales lectus. </p>
                </div>
            </div>
            <div class="row d-flex align-items-center" id="app-feature">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="text-center text-md-end">
                        <div class="feature-item mt-3 wow fadeInLeft" data-wow-delay="300ms">
                            <div class="icon"><i class="fas fa-cog"></i></div>
                            <div class="text">
                                <h3 class="bottom15">
                                    <span class="d-inline-block">Theme Options</span>
                                </h3>
                                <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor
                                    aliquet</p>
                            </div>
                        </div>
                        <div class="feature-item mt-5 wow fadeInLeft" data-wow-delay="350ms">
                            <div class="icon"><i class="fas fa-edit"></i></div>
                            <div class="text">
                                <h3 class="bottom15">
                                    <span class="d-inline-block">Customization</span>
                                </h3>
                                <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor
                                    aliquet</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="app-image top30">
                        <div class="app-slider-lock-btn"></div>
                        <div class="app-slider-lock">
                            <img src="images/iphone-slide-lock.jpg" alt="">
                        </div>
                        <div id="app-slider" class="owl-carousel owl-theme">
                            <div class="item">
                                <img src="images/iphone-slide1.jpg" alt="">
                            </div>
                            <div class="item">
                                <img src="images/iphone-slide2.jpg" alt="">
                            </div>
                            <div class="item">
                                <img src="images/iphone-slide3.jpg" alt="">
                            </div>
                        </div>
                        <img src="images/iphone.png" alt="image">
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="text-center text-md-start">
                        <div class="feature-item mt-3 wow fadeInRight" data-wow-delay="300ms">
                            <div class="icon"><i class="fas fa-code"></i></div>
                            <div class="text">
                                <h3 class="bottom15">
                                    <span class="d-inline-block">Powerful Code</span>
                                </h3>
                                <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor
                                    aliquet</p>
                            </div>
                        </div>
                        <div class="feature-item mt-5 wow fadeInRight" data-wow-delay="350ms">
                            <div class="icon"><i class="far fa-folder-open"></i></div>
                            <div class="text">
                                <h3 class="bottom15">
                                    <span class="d-inline-block">Documentation </span>
                                </h3>
                                <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor
                                    aliquet</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Mobile Apps ends-->
    <!-- Counters -->
    <section id="bg-counters" class="padding bg-counters parallax">
        <div class="container">
            <div class="row align-items-center text-center">
                <div class="col-lg-4 col-md-4 col-sm-4 bottom10">
                    <div class="counters whitecolor  top10 bottom10">
                        <span class="count_nums font-light" data-to="2010" data-speed="2500"> </span>
                    </div>
                    <h3 class="font-light whitecolor top20">Since We Started</h3>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p class="whitecolor top20 bottom20 font-light title">Lorem ipsum dolor sit amet, consectetur
                        adipiscing elit. Nunc mauris arcu, lobortis id interdum vitae, interdum eget elit. </p>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 bottom10">
                    <div class="counters whitecolor top10 bottom10">
                        <span class="count_nums font-light" data-to="895" data-speed="2500"> </span>
                    </div>
                    <h3 class="font-light whitecolor top20">Since We Started</h3>
                </div>
            </div>
        </div>
    </section>
    <!-- Counters ends-->
    <!-- Our Team-->
    <section class="padding_top half-section-alt teams-border">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="heading-title bottom30 wow fadeInLeft" data-wow-delay="300ms">
                        <span class="defaultcolor text-center text-md-start">Quisque tellus risus, adipisci</span>
                        <h2 class="darkcolor font-normal text-center text-md-start">Meet Our Experts</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <p class="text-center text-md-start wow fadeInRight" data-wow-delay="300ms">Curabitur mollis
                        bibendum luctus. Duis suscipit vitae dui sed suscipit. Vestibulum auctor nunc vitae diam
                        eleifend, in maximus metus sollicitudin. Quisque vitae sodales lectus. </p>
                </div>
            </div>
            <div class="row top30">
                <div class="col-md-12">
                    <div id="ourteam-slider" class="owl-carousel">
                        <div class="item">
                            <div class="team-box wow fadeInUp" data-wow-delay="100ms">
                                <div class="image">
                                    <img src="images/team-1.jpg" alt="">
                                </div>
                                <div class="team-content">
                                    <h4 class="darkcolor">Jessica Twain</h4>
                                    <p>Agency Owner</p>
                                    <ul class="social-icons-simple">
                                        <li><a class="facebook" href="javascript:void(0)"><i
                                                    class="fab fa-facebook-f"></i> </a> </li>
                                        <li><a class="twitter" href="javascript:void(0)"><i
                                                    class="fab fa-twitter"></i> </a> </li>
                                        <li><a class="insta" href="javascript:void(0)"><i
                                                    class="fab fa-instagram"></i> </a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="team-box wow fadeInUp" data-wow-delay="150ms">
                                <div class="image">
                                    <img src="images/team-2.jpg" alt="">
                                </div>
                                <div class="team-content">
                                    <h4 class="darkcolor">Jason Wudex </h4>
                                    <p>Designer</p>
                                    <ul class="social-icons-simple">
                                        <li><a class="facebook" href="javascript:void(0)"><i
                                                    class="fab fa-facebook-f"></i> </a> </li>
                                        <li><a class="twitter" href="javascript:void(0)"><i
                                                    class="fab fa-twitter"></i> </a> </li>
                                        <li><a class="insta" href="javascript:void(0)"><i
                                                    class="fab fa-instagram"></i> </a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="team-box wow fadeInUp" data-wow-delay="200ms">
                                <div class="image">
                                    <img src="images/team-3.jpg" alt="">
                                </div>
                                <div class="team-content">
                                    <h4 class="darkcolor">Jessica Twain</h4>
                                    <p>Agency Owner</p>
                                    <ul class="social-icons-simple">
                                        <li><a class="facebook" href="javascript:void(0)"><i
                                                    class="fab fa-facebook-f"></i> </a> </li>
                                        <li><a class="twitter" href="javascript:void(0)"><i
                                                    class="fab fa-twitter"></i> </a> </li>
                                        <li><a class="insta" href="javascript:void(0)"><i
                                                    class="fab fa-instagram"></i> </a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="team-box wow fadeInUp" data-wow-delay="250ms">
                                <div class="image">
                                    <img src="images/team-4.jpg" alt="">
                                </div>
                                <div class="team-content">
                                    <h4 class="darkcolor">Hayden Wood</h4>
                                    <p>Marketing</p>
                                    <ul class="social-icons-simple">
                                        <li><a class="facebook" href="javascript:void(0)"><i
                                                    class="fab fa-facebook-f"></i> </a> </li>
                                        <li><a class="twitter" href="javascript:void(0)"><i
                                                    class="fab fa-twitter"></i> </a> </li>
                                        <li><a class="insta" href="javascript:void(0)"><i
                                                    class="fab fa-instagram"></i> </a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="team-box wow fadeInUp" data-wow-delay="100ms">
                                <div class="image">
                                    <img src="images/team-1.jpg" alt="">
                                </div>
                                <div class="team-content">
                                    <h4 class="darkcolor">Shania Jackson </h4>
                                    <p>Print Media</p>
                                    <ul class="social-icons-simple">
                                        <li><a class="facebook" href="javascript:void(0)"><i
                                                    class="fab fa-facebook-f"></i> </a> </li>
                                        <li><a class="twitter" href="javascript:void(0)"><i
                                                    class="fab fa-twitter"></i> </a> </li>
                                        <li><a class="insta" href="javascript:void(0)"><i
                                                    class="fab fa-instagram"></i> </a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="team-box wow fadeInUp" data-wow-delay="150ms">
                                <div class="image">
                                    <img src="images/team-2.jpg" alt="">
                                </div>
                                <div class="team-content">
                                    <h4 class="darkcolor">Jessica Twain</h4>
                                    <p>Agency Owner</p>
                                    <ul class="social-icons-simple">
                                        <li><a class="facebook" href="javascript:void(0)"><i
                                                    class="fab fa-facebook-f"></i> </a> </li>
                                        <li><a class="twitter" href="javascript:void(0)"><i
                                                    class="fab fa-twitter"></i> </a> </li>
                                        <li><a class="insta" href="javascript:void(0)"><i
                                                    class="fab fa-instagram"></i> </a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="team-box wow fadeInUp" data-wow-delay="200ms">
                                <div class="image">
                                    <img src="images/team-3.jpg" alt="">
                                </div>
                                <div class="team-content">
                                    <h4 class="darkcolor">Jessica Twain</h4>
                                    <p>Agency Owner</p>
                                    <ul class="social-icons-simple">
                                        <li><a class="facebook" href="javascript:void(0)"><i
                                                    class="fab fa-facebook-f"></i> </a> </li>
                                        <li><a class="twitter" href="javascript:void(0)"><i
                                                    class="fab fa-twitter"></i> </a> </li>
                                        <li><a class="insta" href="javascript:void(0)"><i
                                                    class="fab fa-instagram"></i> </a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Our Team ends-->
    <!--Pricing Start-->
    <section id="pricing" class="padding bglight">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 text-center">
                    <div class="heading-title darkcolor wow fadeInUp" data-wow-delay="300ms">
                        <span class="defaultcolor">Quisque tellus risus, adipisci </span>
                        <h2 class="font-normal heading_space_half"> Pricing Offers </h2>
                    </div>
                </div>
                <div class="col-12 text-center ">
                    <div class="price-toggle-wrapper heading_space">
                        <span class="Pricing-toggle-button month active">Monthly</span>
                        <span class="Pricing-toggle-button year">Yearly</span>
                    </div>
                </div>
            </div>
            <div class="owl-carousel owl-theme no-dots" id="price-slider">
                <div class="item">
                    <div class="col-md-12">
                        <div class="pricing-item wow fadeInUp animated sale" data-wow-delay="300ms" data-sale="30">
                            <h3 class="font-light darkcolor">Basic</h3>
                            <p class="bottom30">The standard version</p>
                            <div class="pricing-price darkcolor"><span class="pricing-currency">$9.95</span> /<span
                                    class="pricing-duration">month</span></div>
                            <ul class="pricing-list">
                                <li>Support forum</li>
                                <li>Free hosting</li>
                                <li class="price-not">40MB of storage space</li>
                                <li class="price-not">Social media integration</li>
                                <li class="price-not">10GB of storage space</li>
                            </ul>
                            <a class="button" href="javascript:void(0)">Choose plan</a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="col-md-12">
                        <div class="pricing-item wow fadeInUp animated active selected" data-wow-delay="380ms">
                            <h3 class="font-light darkcolor">Popular</h3>
                            <p class="bottom30">The standard version</p>
                            <div class="pricing-price darkcolor"><span class="pricing-currency">$19.95</span> /<span
                                    class="pricing-duration">month</span></div>
                            <ul class="pricing-list">
                                <li>Support forum</li>
                                <li>Free hosting</li>
                                <li>40MB of storage space</li>
                                <li class="price-not">Social media integration</li>
                                <li class="price-not">10GB of storage space</li>
                            </ul>
                            <a class="button" href="javascript:void(0)">Choose plan</a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="col-md-12">
                        <div class="pricing-item wow fadeInUp animated" data-wow-delay="460ms">
                            <h3 class="font-light darkcolor">Enterprise</h3>
                            <p class="bottom30">The standard version</p>
                            <div class="pricing-price darkcolor"><span class="pricing-currency">$29.95</span> /<span
                                    class="pricing-duration">month</span></div>
                            <ul class="pricing-list">
                                <li>Support forum</li>
                                <li>Free hosting</li>
                                <li>40MB of storage space</li>
                                <li>Social media integration</li>
                                <li class="price-not">10GB of storage space</li>
                            </ul>
                            <a class="button" href="javascript:void(0)">Choose plan</a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="col-md-12">
                        <div class="pricing-item wow fadeInUp animated" data-wow-deeay="400ms">
                            <h3 class="font-light darkcolor">Ultimate</h3>
                            <p class="bottom30">The standard version</p>
                            <div class="pricing-price darkcolor"><span class="pricing-currency">$49.95</span> /<span
                                    class="pricing-duration">month</span></div>
                            <ul class="pricing-list">
                                <li>Support forum</li>
                                <li>Free hosting</li>
                                <li>40MB of storage space</li>
                                <li>Social media integration</li>
                                <li>10GB of storage space</li>
                            </ul>
                            <a class="button" href="javascript:void(0)">Choose plan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Pricing ends-->
    <!-- Gallery -->
    <section id="portfolio" class="position-relative padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center wow fadeIn" data-wow-delay="300ms">
                    <div class="heading-title darkcolor wow fadeInUp" data-wow-delay="300ms">
                        <span class="defaultcolor"> Let's Explore Out </span>
                        <h2 class="font-normal darkcolor heading_space_half"> Our Portfolio </h2>
                    </div>
                    <div class="col-md-6 offset-md-3 heading_space_half">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A dolores omnis provident quam
                            reiciendis voluptatum.</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div id="mosaic-filter" class="cbp-l-filters bottom30 wow fadeIn text-center"
                        data-wow-delay="350ms">
                        <div data-filter="*" class="cbp-filter-item">
                            <span>All</span>
                        </div>
                        <div data-filter=".digital" class="cbp-filter-item">
                            <span>Digital</span>
                        </div>
                        <div data-filter=".design" class="cbp-filter-item">
                            <span>Design</span>
                        </div>
                        <div data-filter=".brand" class="cbp-filter-item">
                            <span>Brand</span>
                        </div>
                        <div data-filter=".graphics" class="cbp-filter-item">
                            <span>Graphics</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div id="grid-mosaic" class="cbp cbp-l-grid-mosaic-flat">
                        <!--Item 1-->
                        <div class="cbp-item brand graphics">
                            <img src="images/gallery-5.jpg" alt="">
                            <div class="gallery-hvr whitecolor">
                                <div class="center-box">
                                    <a href="images/gallery-5.jpg" class="opens" data-fancybox="gallery"
                                        title="Zoom In"> <i class="fa fa-search-plus"></i></a>
                                    <a href="javascript:void(0)" class="opens" title="View Details"> <i
                                            class="fas fa-link"></i></a>
                                    <h4 class="w-100">Sweet Cup</h4>
                                </div>
                            </div>
                        </div>
                        <!--Item 2-->
                        <div class="cbp-item brand graphics design">
                            <img src="images/gallery-7.jpg" alt="">
                            <div class="gallery-hvr whitecolor">
                                <div class="center-box">
                                    <a href="images/gallery-7.jpg" class="opens" data-fancybox="gallery"
                                        title="Zoom In"> <i class="fa fa-search-plus"></i></a>
                                    <a href="javascript:void(0)" class="opens" title="View Details"> <i
                                            class="fas fa-link"></i></a>
                                    <h4 class="w-100">Minimal Things</h4>
                                </div>
                            </div>
                        </div>
                        <!--Item 3-->
                        <div class="cbp-item design digital graphics">
                            <img src="images/gallery-11.jpg" alt="">
                            <div class="gallery-hvr whitecolor">
                                <div class="center-box">
                                    <a href="images/gallery-11.jpg" class="opens" data-fancybox="gallery"
                                        title="Zoom In"> <i class="fa fa-search-plus"></i></a>
                                    <a href="javascript:void(0)" class="opens" title="View Details"> <i
                                            class="fas fa-link"></i></a>
                                    <h4 class="w-100">Semantic Collection</h4>
                                </div>
                            </div>
                        </div>
                        <!--Item 4-->
                        <div class="cbp-item brand graphics">
                            <img src="images/gallery-6.jpg" alt="">
                            <div class="gallery-hvr whitecolor">
                                <div class="center-box">
                                    <a href="images/gallery-6.jpg" class="opens" data-fancybox="gallery"
                                        title="Zoom In"> <i class="fa fa-search-plus"></i></a>
                                    <a href="javascript:void(0)" class="opens" title="View Details"> <i
                                            class="fas fa-link"></i></a>
                                    <h4 class="w-100">Wall Clock</h4>
                                </div>
                            </div>
                        </div>
                        <!--Item 5-->
                        <div class="cbp-item graphics design design">
                            <img src="images/gallery-8.jpg" alt="">
                            <div class="gallery-hvr whitecolor">
                                <div class="center-box">
                                    <a href="images/gallery-8.jpg" class="opens" data-fancybox="gallery"
                                        title="Zoom In"> <i class="fa fa-search-plus"></i></a>
                                    <a href="javascript:void(0)" class="opens" title="View Details"> <i
                                            class="fas fa-link"></i></a>
                                    <h4 class="w-100">Reading Content</h4>
                                </div>
                            </div>
                        </div>
                        <!--Item 6-->
                        <div class="cbp-item brand digital design">
                            <img src="images/gallery-9.jpg" alt="">
                            <div class="gallery-hvr whitecolor">
                                <div class="center-box">
                                    <a href="images/gallery-9.jpg" class="opens" data-fancybox="gallery"
                                        title="Zoom In"> <i class="fa fa-search-plus"></i></a>
                                    <a href="javascript:void(0)" class="opens" title="View Details"> <i
                                            class="fas fa-link"></i></a>
                                    <h4 class="w-100">Great Objects</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <!--Load more itema from another html file using ajax-->
                        <div id="js-loadMore-mosaic" class="cbp-l-loadMore-button ">
                            <a href="load-more.html"
                                class="cbp-l-loadMore-link border-0 font-13 button gradient-btn whitecolor transition-3"
                                rel="nofollow">
                                <span class="cbp-l-loadMore-defaultText">Load More (<span
                                        class="cbp-l-loadMore-loadItems">6</span>)</span>
                                <span class="cbp-l-loadMore-loadingText">Loading <i
                                        class="fas fa-spinner fa-spin"></i></span>
                                <span class="cbp-l-loadMore-noMoreLoading d-none">NO MORE WORKS</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Gallery ends -->
    <!-- Testimonials -->
    <section id="our-testimonial">
        <div class="parallax page-header testimonial-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-6 col-md-12 text-center text-lg-end">
                        <div class="heading-title wow fadeInRight padding_testi" data-wow-delay="300ms">
                            <span class="whitecolor">Quisque tellus risus, adipisci</span>
                            <h2 class="whitecolor font-normal">What People Say</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="owl-carousel" id="testimonial-slider">
                <!--item 1-->
                <div class="item testi-box">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-12 text-center">
                            <div class="testimonial-round d-inline-block">
                                <img src="images/testimonial-5.jpg" alt="">
                            </div>
                            <h4 class="defaultcolor font-light top15"><a href="#.">John Smith</a></h4>
                            <p>UPWORK, New York</p>
                        </div>
                        <div class="col-lg-6 offset-lg-2 col-md-10 offset-md-1 text-lg-start text-center">
                            <p class="bottom15 top90">We have a number of different teams within our agency that
                                specialise in different areas of business so you can be sure that you won’t receive a
                                generic service and although we boast a years and years of service.</p>
                            <span class="d-inline-block test-star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <!--item 2-->
                <div class="item testi-box">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-12 text-center">
                            <div class="testimonial-round d-inline-block">
                                <img src="images/testimonial-2.jpg" alt="">
                            </div>
                            <h4 class="defaultcolor font-light top15"><a href="#.">Hayden Wood</a></h4>
                            <p>FIVERR, Italy</p>
                        </div>
                        <div class="col-lg-6 offset-lg-2 col-md-10 offset-md-1 text-lg-start text-center">
                            <p class="bottom15 top90">Trax’s customer testimonial page is another beauty. Its simple
                                design focuses on videos and standout quotes from customers. This approach is clean,
                                straightforward, text that can be overwhelming and easy to skip.</p>
                            <span class="d-inline-block test-star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <!--item 3-->
                <div class="item testi-box">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-12 text-center">
                            <div class="testimonial-round d-inline-block">
                                <img src="images/testimonial-3.jpg" alt="">
                            </div>
                            <h4 class="defaultcolor font-light top15"><a href="#.">Kevin Miller</a></h4>
                            <p>ENVATO, Australia</p>
                        </div>
                        <div class="col-lg-6 offset-lg-2 col-md-10 offset-md-1 text-lg-start text-center">
                            <p class="bottom15 top90">Trax is a company that provides tools to help professional event
                                planning and execution, and their customers are very happy folks! The thing I love about
                                their customer testimonial page provides content formats.</p>
                            <span class="d-inline-block test-star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <!--item 4-->
                <div class="item testi-box">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-12 text-center">
                            <div class="testimonial-round d-inline-block">
                                <img src="images/testimonial-4.jpg" alt="">
                            </div>
                            <h4 class="defaultcolor font-light top15"><a href="#.">Alina Johanson</a></h4>
                            <p>INTEL, Sidney</p>
                        </div>
                        <div class="col-lg-6 offset-lg-2 col-md-10 offset-md-1 text-lg-start text-center">
                            <p class="bottom15 top90">Startup Institute is a career accelerator that allows
                                professionals to learn new skills, take their careers in a different direction, and
                                pursue a career they are passionate about that have completed the program.</p>
                            <span class="d-inline-block test-star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Testimonials Ends-->
    <!-- Partners-->
    <section id="our-partners" class="padding">
        <div class="container">
            <div class="row">
                <h2 class="d-none">Partners Carousel</h2>
                <div class="col-md-12 col-sm-12">
                    <div id="partners-slider" class="owl-carousel">
                        <div class="item">
                            <div class="logo-item"> <img alt="" src="images/logo-1.png"></div>
                        </div>
                        <div class="item">
                            <div class="logo-item"><img alt="" src="images/logo-2.png"></div>
                        </div>
                        <div class="item">
                            <div class="logo-item"><img alt="" src="images/logo-3.png"></div>
                        </div>
                        <div class="item">
                            <div class="logo-item"><img alt="" src="images/logo-4.png"></div>
                        </div>
                        <div class="item">
                            <div class="logo-item"><img alt="" src="images/logo-5.png"></div>
                        </div>
                        <div class="item">
                            <div class="logo-item"><img alt="" src="images/logo-1.png"></div>
                        </div>
                        <div class="item">
                            <div class="logo-item"><img alt="" src="images/logo-2.png"></div>
                        </div>
                        <div class="item">
                            <div class="logo-item"><img alt="" src="images/logo-3.png"></div>
                        </div>
                        <div class="item">
                            <div class="logo-item"><img alt="" src="images/logo-4.png"></div>
                        </div>
                        <div class="item">
                            <div class="logo-item"><img alt="" src="images/logo-5.png"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Partners ends-->
    <!--Blog-->
    <section class="bglight padding" id="blog">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="heading-title darkcolor wow fadeInUp" data-wow-delay="100ms">
                        <span class="defaultcolor">Read Out Our</span>
                        <h2 class="font-normal darkcolor heading_space_half"> Latest Blog </h2>
                    </div>
                    <div class="col-md-6 offset-md-3 heading_space">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A dolores omnis provident quam
                            reiciendis voluptatum.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="news_item shadow wow fadeInUp" data-wow-delay="200ms">
                        <div class="blog-img">
                            <a class="image" href="blog-1.html">
                                <img src="images/blog-1.jpg" alt="Latest News" class="img-responsive">
                            </a>
                        </div>
                        <div class="news_desc">
                            <h3 class="text-capitalize font-normal darkcolor"><a href="blog-1.html">Next Large Social
                                    Network</a></h3>
                            <ul class="meta-tags top20 bottom20">
                                <li><a href="#."><i class="fas fa-calendar-alt"></i>Jan 14</a></li>
                                <li><a href="#."> <i class="far fa-user"></i>Peter</a></li>
                                <li><a href="#."><i class="far fa-comment-dots"></i>7</a></li>
                            </ul>
                            <p>Lorem Ipsum is simply dummy text of the printing industry. Lorem has been dummy text ever
                                since the 1500s...</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="news_item shadow wow fadeInUp" data-wow-delay="300ms">
                        <div class="blog-img">
                            <div class="owl-carousel owl-theme owl-blog-item">
                                <div class="image item">
                                    <img src="images/blog-4.jpg" alt="image">
                                </div>
                                <div class="image item">
                                    <img src="images/blog-3.jpg" alt="image">
                                </div>
                                <div class="image item">
                                    <img src="images/blog-2.jpg" alt="image">
                                </div>
                                <div class="image item">
                                    <img src="images/blog-6.jpg" alt="image">
                                </div>
                            </div>
                        </div>
                        <div class="news_desc">
                            <h3 class="text-capitalize font-normal darkcolor"><a href="blog-1.html">The Art of
                                    Finding Great Ideas</a></h3>
                            <ul class="meta-tags top20 bottom20">
                                <li><a href="#."><i class="fas fa-calendar-alt"></i>Feb 19</a></li>
                                <li><a href="#."> <i class="far fa-user"></i>John</a></li>
                                <li><a href="#."><i class="far fa-comment-dots"></i>9</a></li>
                            </ul>
                            <p>Lorem Ipsum is simply dummy text of the printing industry. Lorem has been dummy text ever
                                since the 1500s...</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="news_item shadow mb-0 wow fadeInUp" data-wow-delay="400ms">
                        <div class="blog-img">
                            <a data-fancybox="" href="video/video.mp4">
                                <div class="play-hvr">
                                    <div class="play-icon">
                                        <i class="fas fa-play"></i>
                                    </div>
                                </div>
                            </a>
                            <div class="image">
                                <img src="images/blog-5.jpg" alt="Latest News" class="img-responsive">
                            </div>
                        </div>
                        <div class="news_desc">
                            <h3 class="text-capitalize font-normal darkcolor"><a href="blog-1.html">3 Tips for
                                    Creating Your Own Blog</a></h3>
                            <ul class="meta-tags top20 bottom20">
                                <li><a href="#."><i class="fas fa-calendar-alt"></i>May 21</a></li>
                                <li><a href="#."> <i class="far fa-user"></i>David</a></li>
                                <li><a href="#."><i class="far fa-comment-dots"></i>4</a></li>
                            </ul>
                            <p>Lorem Ipsum is simply dummy text of the printing industry. Lorem has been dummy text ever
                                since the 1500s...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Blog ends-->
    <!--contact us-->
    <section id="contact" class="position-relative padding_bottom_half">
        <div class="container whitebox padding_bottom_half">
            <div class="padding_top">
                <div class="row">
                    <div class="col-md-12 text-center wow fadeInUp mt-n3" data-wow-delay="300ms">
                        <span class="defaultcolor">Quisque tellus risus</span>
                        <div class="heading-title bottom25 darkcolor">
                            <h2 class="font-normal darkcolor"> Contact Us </h2>
                        </div>
                        <div class="col-md-6 offset-md-3 heading_space">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A dolores omnis provident quam
                                reiciendis voluptatum.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 order-md-2 text-center text-md-start">
                        <div class="contact-meta pl-0 pl-sm-5 wow fadeInRight" data-wow-delay="300ms">
                            <div class="heading-title heading_small">
                                <span class="defaultcolor mb-2">Trax Agency Worldwide</span>
                                <h3 class="darkcolor font-normal">Our London Agency</h3>
                            </div>
                            <div class="my-3">
                                <p class="bottom10">Address: 309, New Cavendish St, EC1Y 3WK</p>
                                <p class="bottom10">0800 214 5252</p>
                                <p class="bottom10">0400 20778972</p>
                                <p class="bottom10"><a href="mailto:polpo@traxagency.co.au">polpo@traxagency.com</a>
                                </p>
                                <p class="bottom10">Mon-Fri: 9am-5pm</p>
                            </div>
                            <ul class="social-icons no-border mb-4 mb-md-0 wow fadeInUp" data-wow-delay="300ms">
                                <li><a href="javascript:void(0)" class="facebook"><i
                                            class="fab fa-facebook-f"></i> </a> </li>
                                <li><a href="javascript:void(0)" class="twitter"><i class="fab fa-twitter"></i>
                                    </a> </li>
                                <li><a href="javascript:void(0)" class="linkedin"><i
                                            class="fab fa-linkedin-in"></i> </a> </li>
                                <li><a href="javascript:void(0)" class="insta"><i class="fab fa-instagram"></i>
                                    </a> </li>
                                <li><a href="javascript:void(0)" class="whatsapp"><i class="fab fa-whatsapp"></i>
                                    </a> </li>
                                <li><a href="javascript:void(0)"><i class="far fa-envelope"></i> </a> </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="heading-title  wow fadeInLeft" data-wow-delay="300ms">
                            <form class="getin_form" onsubmit="return false;">
                                <div class="row px-2">
                                    <div class="col-md-12 col-sm-12" id="result1"></div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="name1" class="d-none"></label>
                                            <input class="form-control" id="name1" type="text"
                                                placeholder="Name" required="" name="userName">
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
    <!-- map -->
    <div class="w-100">
        <div id="map" class="full-map"></div>
    </div>
    <!-- map end -->
    <!-- Stay connected US -->
    <section id="stayconnect">
        <div class="container position-relative">
            <div class="contactus-wrapp position-absolute shadow-equal">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="heading-title wow fadeInUp text-center text-md-start" data-wow-delay="300ms">
                            <h3 class="darkcolor bottom20">Stay Connected</h3>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <form class="getin_form wow fadeInUp" data-wow-delay="400ms" onsubmit="return false;">
                            <div class="row">
                                <div class="col-md-12 col-sm-12" id="result"></div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label for="userName" class="d-none"></label>
                                        <input class="form-control" type="text" placeholder="Name" required
                                            id="userName" name="userName">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label for="companyName" class="d-none"></label>
                                        <input class="form-control" type="text" placeholder="Company"
                                            id="companyName" name="companyName">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label for="email" class="d-none"></label>
                                        <input class="form-control" type="email" placeholder="Email" required
                                            id="email" name="email">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <button type="submit" class="button gradient-btn w-100"
                                        id="submit_btn">subscribe</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact US ends -->
    <!--Site Footer Here-->
    <footer id="site-footer" class=" bgdark padding_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer_panel padding_bottom_half bottom20">
                        <a href="index.html" class="footer_logo bottom25"><img src="images/logo-transparent.png"
                                alt="trax"></a>
                        <p class="whitecolor bottom25">Keep away from people who try to belittle your ambitions Small
                            people always do that but the really great Friendly.</p>
                        <div class="d-table w-100 address-item whitecolor bottom25">
                            <span class="d-table-cell align-middle"><i class="fas fa-mobile-alt"></i></span>
                            <p class="d-table-cell align-middle bottom0">
                                +01 - 123 - 4567 <a class="d-block"
                                    href="mailto:web@support.com">web@support.com</a>
                            </p>
                        </div>
                        <ul class="social-icons white wow fadeInUp" data-wow-delay="300ms">
                            <li><a href="javascript:void(0)" class="facebook"><i class="fab fa-facebook-f"></i>
                                </a> </li>
                            <li><a href="javascript:void(0)" class="twitter"><i class="fab fa-twitter"></i> </a>
                            </li>
                            <li><a href="javascript:void(0)" class="linkedin"><i class="fab fa-linkedin-in"></i>
                                </a> </li>
                            <li><a href="javascript:void(0)" class="insta"><i class="fab fa-instagram"></i> </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer_panel padding_bottom_half bottom20">
                        <h3 class="whitecolor bottom25">Latest News</h3>
                        <ul class="latest_news whitecolor">
                            <li> <a href="#.">Aenean tristique justo et... </a> <span
                                    class="date defaultcolor">15 March 2019</span> </li>
                            <li> <a href="#.">Phasellus dapibus dictum augue... </a> <span
                                    class="date defaultcolor">15 March 2019</span> </li>
                            <li> <a href="#.">Mauris blandit vitae. Praesent non... </a> <span
                                    class="date defaultcolor">15 March 2019</span> </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer_panel padding_bottom_half bottom20 ps-0 ps-lg-5">
                        <h3 class="whitecolor bottom25">Navigation</h3>
                        <ul class="links">
                            <li><a href="#home" class="pagescroll">Home</a></li>
                            <li><a href="#about" class="pagescroll scrollupto">About Us</a></li>
                            <li><a href="#pricing" class="pagescroll">Our Pricing</a></li>
                            <li><a href="#portfolio" class="pagescroll">Portfolio</a></li>
                            <li><a href="#blog" class="pagescroll">Our Blog</a></li>
                            <li><a href="#contact" class="pagescroll">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer_panel padding_bottom_half bottom20">
                        <h3 class="whitecolor bottom25">Business hours</h3>
                        <p class="whitecolor bottom25">Our support available to help you 24 hours a day, seven days
                            week</p>
                        <ul class="hours_links whitecolor">
                            <li><span>Monday-Saturday:</span> <span>8.00-18.00</span></li>
                            <li><span>Friday:</span> <span>09:00-21:00</span></li>
                            <li><span>Sunday:</span> <span>09:00-20:00</span></li>
                            <li><span>Calendar Events:</span> <span>24-Hour Shift</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--Footer ends-->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.6.0.min.js"></script>
    <!--Bootstrap Core-->
    <script src="js/propper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--to view items on reach-->
    <script src="js/jquery.appear.js"></script>
    <!--Owl Slider-->
    <script src="js/owl.carousel.min.js"></script>
    <!--number counters-->
    <script src="js/jquery-countTo.js"></script>
    <!--Parallax Background-->
    <script src="js/parallaxie.js"></script>
    <!--Cubefolio Gallery-->
    <script src="js/jquery.cubeportfolio.min.js"></script>
    <!--Fancybox js-->
    <script src="js/jquery.fancybox.min.js"></script>
    <!--Tooltip js-->
    <script src="js/tooltipster.min.js"></script>
    <!--wow js-->
    <script src="js/wow.js"></script>
    <!--Revolution SLider-->
    <script src="js/revolution/jquery.themepunch.tools.min.js"></script>
    <script src="js/revolution/jquery.themepunch.revolution.min.js"></script>
    <!-- SLIDER REVOLUTION 5.0 EXTENSIONS -->
    <script src="js/revolution/extensions/revolution.extension.actions.min.js"></script>
    <script src="js/revolution/extensions/revolution.extension.carousel.min.js"></script>
    <script src="js/revolution/extensions/revolution.extension.kenburn.min.js"></script>
    <script src="js/revolution/extensions/revolution.extension.layeranimation.min.js"></script>
    <script src="js/revolution/extensions/revolution.extension.migration.min.js"></script>
    <script src="js/revolution/extensions/revolution.extension.navigation.min.js"></script>
    <script src="js/revolution/extensions/revolution.extension.parallax.min.js"></script>
    <script src="js/revolution/extensions/revolution.extension.slideanims.min.js"></script>
    <script src="js/revolution/extensions/revolution.extension.video.min.js"></script>
    <!--map js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgIfLQi8KTxTJahilcem6qHusV-V6XXjw"></script>
    <script src="js/map.js"></script>
    <!--custom functions and script-->
    <script src="js/functions.js"></script>
</body>

<!-- Mirrored from trax.acrothemes.com/bootstrap-v5/single-index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 18 Jun 2022 06:10:40 GMT -->

</html>
