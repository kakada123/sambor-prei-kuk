<!doctype html>
<html lang="en">

<head>
    <!-- Basic Page Needs =====================================-->
    <meta charset="utf-8">

    <!-- Mobile Specific Metas ================================-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Site Title- -->
    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- CSS
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('front-end/css/bootstrap.min.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('front-end/css/font-awesome.min.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('front-end/css/animate.css') }}">

    <!-- IcoFonts -->
    <link rel="stylesheet" href="{{ asset('front-end/css/icofonts.css') }}">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('front-end/css/owlcarousel.min.css') }}">

    <!-- slick -->
    <link rel="stylesheet" href="{{ asset('front-end/css/slick.css') }}">
    <!-- navigation -->
    <link rel="stylesheet" href="{{ asset('front-end/css/navigation.css') }}?v=1.0.4">

    <!-- magnific popup -->
    <link rel="stylesheet" href="{{ asset('front-end/css/magnific-popup.css') }}">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('front-end/css/style.css') }}?v=1.0.4">

    <link rel="stylesheet" href="{{ asset('front-end/css/colors/color-2.css') }}">

    <!-- Responsive -->
    <link rel="stylesheet" href="{{ asset('front-end/css/responsive.css') }}?v=1.0.4">
    <link rel="icon" href="{{ asset('front-end/images/icon.ico') }}" sizes="any">
</head>

<body>
    <div class="body-inner-content">
        <section class="header-middle">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 align-self-center">
                        <div class="header-logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('assets/image/logo-white.jpg') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-8 align-self-center">
                        <div class="banner-imgr">
                            <ul class="right-menu align-to-right">
                                <li class="pagess-search">
                                    <a>
                                        <form class="form">
                                            <input name="key" class="form-control border-radius" type="text"
                                                placeholder="Search" aria-label="Search">
                                        </form>
                                    </a>
                                </li>
                                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <li class="language">
                                        <a rel="{{ $localeCode }}"
                                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                            <img style="cursor: pointer;"
                                                src="{{ asset('front-end/images/icon/' . $localeCode . '.png') }}">
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- col end -->
                </div>
                <!-- row  end -->
            </div>
            <!-- container end -->
        </section>
        <!-- header nav start-->
        @include('frontend/components/header')
        @yield('content')
        <!-- footer start -->
        <footer class="ts-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright-text text-center">
                            <p>&copy; {{ date('Y') }} អាជ្ញាធរជាតិសំបូរព្រៃគុក National Authority For Sambor Prei
                                Kuk</p>
                        </div>
                    </div>
                </div>
                <div id="back-to-top" class="back-to-top">
                    <button class="btn btn-primary" title="Back to Top">
                        <i class="fa fa-angle-up"></i>
                    </button>
                </div><!-- Back to top end -->
            </div><!-- Container end-->
        </footer>
        <!-- footer end -->
    </div>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v15.0"
        nonce="3cXGsUHx"></script>
    <!-- javaScript Files
    <!-- initialize jQuery Library -->
    <script src="{{ asset('front-end/js/jquery.min.js') }}"></script>
    <!-- navigation JS -->
    <script src="{{ asset('front-end/js/navigation.js') }}"></script>
    <!-- Popper JS -->
    <script src="{{ asset('front-end/js/popper.min.js') }}"></script>
    <!-- magnific popup JS -->
    <script src="{{ asset('front-end/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Bootstrap jQuery -->
    <script src="{{ asset('front-end/js/bootstrap.min.js') }}"></script>
    <!-- Owl Carousel -->
    <script src="{{ asset('front-end/js/owl-carousel.2.3.0.min.js') }}"></script>
    <!-- slick -->
    <script src="{{ asset('front-end/js/slick.min.js') }}"></script>
    <!-- smooth scroling -->
    <script src="{{ asset('front-end/js/smoothscroll.js') }}"></script>
    <script src="{{ asset('front-end/js/main.js') }}"></script>
   <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-2ZPFFQMLBF"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-2ZPFFQMLBF');
    </script>
</body>

</html>
