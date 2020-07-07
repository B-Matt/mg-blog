<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- START General Info -->
    <meta charset="utf-8">
    <link rel="canonical" href="{{ URL::current() }}" />
    <link rel="alternate" href="{{ URL::current() }}" hreflang="{{ str_replace('_', '-', app()->getLocale()) }}" />
    
    @yield('title')
    <meta name="description" content="{{ isset($settings) == true ? $settings->description : '' }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="cleartype" content="on">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="theme-color" content="{{ isset($settings) == true ? $settings->theme_color : '' }}" />
    <link rel="shortcut icon" href="{{ isset($settings) == true ? $settings->icon_fav : '' }}" />
    <link rel="apple-touch-icon" href="{{ isset($settings) == true ? $settings->icon_apple : '' }}" />
    <meta name="robots" content="index, follow">
    <!-- END General Info -->

    <!-- START Social Graphs -->
    @yield('social-meta')
    <!-- END Social Graphs -->

    <!-- START JSON-LD -->
    @yield('json-ld')
    <!-- END JSON-LD -->

    <!-- START CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- END CSRF Token -->

    <!-- START Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- END Scripts -->

    <!-- START Fonts -->
    <link rel='dns-prefetch' href='//fonts.googleapis.com' />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <!-- END Fonts -->

    <!-- START Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- END Styles -->
</head>

<body>
    <div id="app">
        <!-- Header section -->
        <header class="header-section">
            <div class="logo">
                <img src="{{ asset('/img/logo/mg_logo_dark.svg') }}" alt="Master Games Logo">
            </div>
            <!-- Navigation -->
            <div class="responsive"><i class="flaticon-menu"></i></div>
            <nav>
                <ul class="menu-list">
                    <li><a href="https://themastergames.com/" title="Master Games - Website">Home</a></li>
                    <li><a href="https://themastergames.com/products/index" title="Master Games - Products">Products</a></li>
                    <li class="active"><a href="https://blog.themastergames.com/blog/" title="Master Games - Blog">Blog</a></li>
                </ul>
            </nav>
        </header>
        <!-- Header section end -->

        <!-- Content section -->
        <div class="content-section">
            @yield('content')
        </div>
        <!-- Content section end -->

        <!-- Footer section -->
        <footer class="footer-section">

            <div class="footer-logo">
                <a href="#" title="Go up">
                    <img src="{{ asset('/img/logo/mg_logo_white.svg') }}" alt="Master Games Logo">
                </a>
            </div>

            <ul class="footer-follow px-0">
                <li><a href="https://www.facebook.com/MasterGamesStudios/" rel="noopener" target="_blank"
                        title="Master Games on Facebook" hreflang="en"><i class="flaticon-facebook"></i></a></li>
                <li><a href="https://www.youtube.com/channel/UCHuppbLSzTvlwif3vAnSrww" rel="noopener" target="_blank"
                        title="Master Games on YouTube" hreflang="en"><i class="flaticon-youtube-logo"></i></a></li>
                <li><a href="https://www.instagram.com/master_games_studio/" rel="noopener" target="_blank"
                        title="Master Games on Instagram" hreflang="en"><i class="flaticon-instagram"></i></a></li>
                <li><a href="https://twitter.com/MasterGamesStu2?lang=en" rel="noopener" target="_blank"
                        title="Master Games on Twitter" hreflang="en"><i class="flaticon-twitter"></i></a></li>
            </ul>

            <p>
                © 2020. <a href="https://themastergames.com" title="Master Games Homepage">Master Games</a> All rights reserved.
            </p>

            <ul class="footer-menu px-0">
                <li><a href="privacy-policy.html" title="Privacy Policy">Privacy Policy</a></li>
                <li><a href="terms-of-service.html" title="Terms of service">Terms of service</a></li>
            </ul>
        </footer>
        <!-- Footer section end -->
    </div>

    @if(isset($settings) && isset($settings->google_tag))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $settings->google_tag }}" type="text/javascript"></script>
    <script type="text/javascript">
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', '{{ $settings->google_tag }}');
    </script>
    @endif
</body>

</html>
