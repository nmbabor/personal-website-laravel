<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="description" content="@yield('meta_description', readConfig('meta_description'))" />
    <meta name="keywords" content="@yield('meta_keywords', readConfig('meta_keywords'))" />
    <meta name="author" content="{{ readConfig('site_name') }}" />
    <meta property="og:title" content="@yield('title', readConfig('site_name'))" />
    <meta property="og:image" content="@yield('og_image', imageRecover(readconfig('site_logo')))" />
    <meta property="og:url" content="{{ request()->fullUrl() }}" />
    <meta property="og:site_name" content="{{ readConfig('site_name') }}" />
    <meta property="og:description" content="@yield('meta_description', readConfig('meta_description'))" />
    <meta name="twitter:title" content="@yield('title', readConfig('site_name'))" />
    <meta name="twitter:image" content="@yield('og_image', imageRecover(readconfig('site_logo')))" />
    <meta name="twitter:url" content="{{ request()->fullUrl() }}" />

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="{{ imageRecover(readconfig('favicon_icon')) }}" type="image/x-icon">

    <title> @yield('title') | {{ readConfig('site_name') }}</title>

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/frontend/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/frontend/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/custom.css') }}" rel="stylesheet" />
    @stack('style')
</head>

<body>

    <!-- ======= Mobile nav toggle button ======= -->
    <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

    <!-- ======= Header ======= -->
    <header id="header">
        <div class="d-flex flex-column">

            <div class="profile">
                <img src="{{ asset('assets/frontend//img/babors.jpg') }}" alt=""
                    class="img-fluid rounded-circle">
                <h1 class="text-light"><a href="index.html">Author</a></h1>
                <div class="social-links mt-3 text-center">
                    @if (readconfig('facebook_link') != null)
                        <a title="Facebook" href="{{ readconfig('facebook_link') }}" target="_blank" class="facebook"><i
                                class="bx bxl-facebook"></i></a>
                    @endif
                    @if (readconfig('twitter_link') != null)
                        <a title="Twitter" href="{{ readconfig('twitter_link') }}" target="_blank" class="twitter"><i
                                class="bx bxl-twitter"></i></a>
                    @endif
                    @if (readconfig('linkedin_link') != null)
                        <a title="Linkedin" href="{{ readconfig('linkedin_link') }}" target="_blank" class="linkedin"><i
                                class="bx bxl-linkedin"></i></a>
                    @endif
                    @if (readconfig('youtube_link') != null)
                        <a title="Youtube" href="{{ readconfig('youtube_link') }}" target="_blank" class="youtube"><i
                                class="bx bxl-youtube"></i></a>
                    @endif
                    @if (readconfig('instagram_link') != null)
                        <a title="Instagram" href="{{ readconfig('instagram_link') }}" target="_blank" class="instagram"><i
                                class="bx bxl-instagram"></i></a>
                    @endif
                    @if (readconfig('pinterest_link') != null)
                        <a title="Pinterest" href="{{ readconfig('pinterest_link') }}" target="_blank" class="pinterest"><i
                                class="bx bxl-pinterest"></i></a>
                    @endif

                    @if (readconfig('tumblr_link') != null)
                        <a title="Tumblr" href="{{ readconfig('tumblr_link') }}" target="_blank" class="tumblr"><i
                                class="bx bxl-tumblr"></i></a>
                    @endif
                    @if (readconfig('github_link') != null)
                        <a title="Github" href="{{ readconfig('github_link') }}" target="_blank" class="github"><i
                                class="bx bxl-github"></i></a>
                    @endif
                    @if (readconfig('skype_link') != null)
                        <a title="Skype" href="{{ readconfig('skype_link') }}" target="_blank" class="skype"><i
                                class="bx bxl-skype"></i></a>
                    @endif
                </div>
            </div>

            <nav id="navbar" class="nav-menu navbar">
                <ul>
                    <li><a href="#hero" class="nav-link scrollto active"><i class="bx bx-home"></i>
                            <span>Home</span></a></li>
                    <li><a href="#about" class="nav-link scrollto"><i class="bx bx-user"></i> <span>About</span></a>
                    </li>
                    <li><a href="#resume" class="nav-link scrollto"><i class="bx bx-file-blank"></i>
                            <span>Resume</span></a></li>
                    <li><a href="#portfolio" class="nav-link scrollto"><i class="bx bx-book-content"></i>
                            <span>Portfolio</span></a></li>
                    <li><a href="#services" class="nav-link scrollto"><i class="bx bx-server"></i>
                            <span>Services</span></a></li>
                    <li><a href="#contact" class="nav-link scrollto"><i class="bx bx-envelope"></i>
                            <span>Contact</span></a></li>
                </ul>
            </nav><!-- .nav-menu -->
        </div>
    </header><!-- End Header -->

    @yield('hero')

    <main id="main">
        @yield('content')
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>{{ readConfig('site_name') }}</span></strong>
            </div>
            <!--<div class="credits">
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
          </div>-->
        </div>
    </footer><!-- End  Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <script src="{{ asset('assets/frontend/vendor/purecounter/purecounter.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendor/typed.js/typed.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/frontend/js/main.js') }}"></script>
    @stack('script')

</body>

</html>
