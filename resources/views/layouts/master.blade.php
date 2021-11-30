

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Construction Html5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">

    <!-- Icon -->
    <link rel="icon" type="image/png" href="{{ asset('styles/images/logo/logo.png') }}">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('styles/plugins/bootstrap/bootstrap.min.css') }}">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="{{ asset('styles/plugins/fontawesome/css/all.min.css') }}">
    <!-- Animation -->
    <link rel="stylesheet" href="{{ asset('styles/plugins/animate-css/animate.css') }}">
    <!-- slick Carousel -->
    <link rel="stylesheet" href="{{ asset('styles/plugins/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/plugins/slick/slick-theme.css') }}">
    <!-- Colorbox -->
    <link rel="stylesheet" href="{{ asset('styles/plugins/colorbox/colorbox.css') }}">
    <!-- Aoi -->
    <link rel="stylesheet" href="{{ asset('styles//vendor/aos/aos.css') }}">
    <!-- Template styles-->
    <link rel="stylesheet" href="{{ asset('styles/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('styles/css/preload.min.css') }}">

</head>

<body>

    @include('layouts.preload')

    <div class="body-inner">

        <div id="top-bar" class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <ul class="top-info text-center text-md-left">
                            <li><i class="fas fa-map-marker-alt"></i>
                                <p class="info-text">Graha BNPB - Jl. Pramuka Kav.38 Jakarta Timur 13120</p>
                            </li>
                        </ul>
                    </div>
                    <!--/ Top info end -->

                    <div class="col-lg-4 col-md-4 top-social text-center text-md-right">
                        <ul class="list-unstyled">
                            <li>
                                <a title="Facebook" href="https://facebbok.com/themefisher.com">
                                    <span class="social-icon"><i class="fab fa-facebook-f"></i></span>
                                </a>
                                <a title="Twitter" href="https://twitter.com/themefisher.com">
                                    <span class="social-icon"><i class="fab fa-twitter"></i></span>
                                </a>
                                <a title="Instagram" href="https://instagram.com/themefisher.com">
                                    <span class="social-icon"><i class="fab fa-instagram"></i></span>
                                </a>
                                <a title="Linkdin" href="https://github.com/themefisher.com">
                                    <span class="social-icon"><i class="fab fa-github"></i></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--/ Top social end -->
                </div>
                <!--/ Content row end -->
            </div>
            <!--/ Container end -->
        </div>
        <!--/ Topbar end -->
        <!-- Header start -->
        <header id="header" class="header-one">
            <div class="bg-white">
                <div class="container">
                    <div class="logo-area">
                        <div class="row align-items-center">
                            <div class="logo col-lg-3 text-center text-lg-left mb-3 mb-md-5 mb-lg-0">
                                <a class="d-block" href="#">
                                    <img loading="lazy" src="{{ asset('styles/images/logo/logo4.png') }}" alt="Ina-PDRI" style="width: 200px; height: auto;">
                                </a>
                            </div>
                            <!-- logo end -->

                            <div class="col-lg-9 header-right ">
                                <ul class="top-info-box ">
                                    <li>
                                        <div class="info-box ">
                                            <div class="info-box-content ">
                                                <p class="info-box-title ">Call Us</p>
                                                <p class="info-box-subtitle "><a href="tel:(+9) 847-291-4353 ">021-29827793</a></p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="info-box ">
                                            <div class="info-box-content ">
                                                <p class="info-box-title ">Fax</p>
                                                <p class="info-box-subtitle "><a href="mailto:office@Constra.com ">021-21281200</a></p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="last ">
                                        <div class="info-box last ">
                                            <div class="info-box-content ">
                                                <p class="info-box-title ">Email</p>
                                                <p class="info-box-subtitle ">contact@bnpb.go.id</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="header-get-a-quote">
                                        @if(Auth::check())
                                            <a class="btn btn-primary" href="{{ route('login') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign Out</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        @else
                                            {{-- <nav class="navbar navbar-expand-lg navbar-dark p-0">
                
                                                <div id="navbar-collapse" class="collapse navbar-collapse">
                                                    <ul class="nav navbar-nav mr-auto">
                                                        <li class="nav-item dropdown">
                                                            <a class="nav-link dropdown-toggle btn btn-primary" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            USER
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                                <a class="dropdown-item" href="{{ route('login') }}">Sign In</a>
                                                                <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </nav> --}}
                                            <a class="btn btn-primary" href="{{ route('login') }}">Sign In</a>
                                        @endif
                                    
                                </ul>
                                
                                <!-- Ul end -->
                            </div>
                            <!-- header right end -->
                        </div>
                        <!-- logo area end -->

                    </div>
                    <!-- Row end -->
                </div>
                <!-- Container end -->
            </div>

            <div class="site-navigation">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <nav class="navbar navbar-expand-lg navbar-dark p-0">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>

                                {{-- <div id="navbar-collapse" class="collapse navbar-collapse">
                                    <ul class="nav navbar-nav mr-auto">
                                        <li class="nav-item active "><a class="nav-link " href="contact.html "></a></li>
                                    </ul>
                                </div> --}}
                            </nav>
                        </div>
                        <!--/ Col end -->
                    </div>
                    <!--/ Row end -->

                    {{-- <div class="nav-search">
                        <span id="search"><i class="fa fa-search"></i></span>
                    </div> --}}
                    <!-- Search end -->

                    {{-- <div class="search-block" style="display: none;">
                        <label for="search-field" class="w-100 mb-0">
                            <input type="text" class="form-control" id="search-field" placeholder="Type what you want and enter">
                        </label>
                        <span class="search-close">&times;</span>
                    </div> --}}
                    <!-- Site search end -->
                </div>
                <!--/ Container end -->

            </div>
            <!--/ Navigation end -->
        </header>
        <!--/ Header end -->

        @yield('content')

        <footer id="footer" class="footer bg-overlay">
            <div class="footer-main">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-lg-4 col-md-6 footer-widget footer-about">
                            <h3 class="widget-title">About Us</h3>
                            <img loading="lazy" width="200px" class="footer-logo" src="{{ asset('styles/images/logo/logo4.png') }}" alt="Ina-PDRI">
                            <p>Indeks pemulihan pascabencana dimana wilayah terdampak bencana hanya sebagian kecil dari wilayah suatu kabupaten kota mengukur di tingkat desa kelurahan</p>
                        </div>

                        <div class="col-lg-4 col-md-6 footer-widget mt-5 mt-md-0">
                            <h3 class="widget-title">Working Hours</h3>
                            <div class="working-hours">
                                We work 7 days a week, every day excluding major holidays. Contact us if you have an emergency, with our Hotline and Contact form.
                                <br><br> Monday - Friday: <span class="text-right">10:00 - 16:00 </span>
                                <br> Saturday: <span class="text-right">12:00 - 15:00</span>
                                <br> Sunday and holidays: <span class="text-right">09:00 - 12:00</span>
                            </div>
                        </div>
                        <!-- Col end -->

                        <div class="col-lg-3 col-md-6 mt-5 mt-lg-0 footer-widget">
                            <h3 class="widget-title">Services</h3>
                            <ul class="list-arrow">
                                <li><a href="service-single.html">Pre-Construction</a></li>
                                <li><a href="service-single.html">General Contracting</a></li>
                                <li><a href="service-single.html">Construction Management</a></li>
                                <li><a href="service-single.html">Design and Build</a></li>
                                <li><a href="service-single.html">Self-Perform Construction</a></li>
                            </ul>
                        </div>
                        <!-- Col end -->
                    </div>
                    <!-- Row end -->
                </div>
                <!-- Container end -->
            </div>
            <!-- Footer main end -->

            <div class="copyright">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="copyright-info text-center text-md-left">
                                <span>Copyright &copy; 2021 <strong><a href="https://inapdri.bnpb.co.id">Indeks Rehabilitasi & Rekonstruksi Pascabencana - BNPB</a></strong>.</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="footer-menu text-center text-md-right">
                                <ul class="list-unstyled">
                                    <li><a href="about.html">About</a></li>
                                    <li><a href="team.html">Our people</a></li>
                                    <li><a href="faq.html">Faq</a></li>
                                    <li><a href="news-left-sidebar.html">Blog</a></li>
                                    <li><a href="pricing.html">Pricing</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Row end -->

                    <div id="back-to-top" data-spy="affix" data-offset-top="10" class="back-to-top position-fixed">
                        <button class="btn btn-primary" title="Back to Top">
                            <i class="fa fa-angle-double-up"></i>
                        </button>
                    </div>

                </div>
                <!-- Container end -->
            </div>
            <!-- Copyright end -->
        </footer>
        <!-- Footer end -->


        <!-- initialize jQuery Library -->
        <script src="{{ asset('styles/plugins/jQuery/jquery.min.js') }}"></script>
        <!-- Bootstrap jQuery -->
        <script src="{{ asset('styles/plugins/bootstrap/bootstrap.min.js') }}" defer></script>
        <!-- Slick Carousel -->
        <script src="{{ asset('styles/plugins/slick/slick.min.js') }}"></script>
        <script src="{{ asset('styles/plugins/slick/slick-animation.min.js') }}"></script>
        <!-- Color box -->
        <script src="{{ asset('styles/plugins/colorbox/jquery.colorbox.js') }}"></script>
        <!-- shuffle -->
        <script src="{{ asset('styles/plugins/shuffle/shuffle.min.js') }}" defer></script>
         <!-- aos -->
        <script src="{{ asset('styles/vendor/aos/aos.js') }}"></script>


        <!-- Google Map API Key-->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU" defer></script>
        <!-- Google Map Plugin-->
        <script src="{{ asset('styles/plugins/google-map/map.js') }}" defer></script>

        <!-- Template custom -->
        <script src="{{ asset('styles/js/script.js') }}"></script>
	    <script src="{{ asset('styles/vendor/preloader.js') }}"></script>

    </div>
    <!-- Body inner end -->
</body>

</html>
