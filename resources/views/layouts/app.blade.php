<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
                    <li><a href="https://themastergames.com/" title="Master Games Website">Home</a></li>
                    <li><a href="https://themastergames.com/products/index" title="Master Games Products">Products</a>
                    </li>
                    <li class="active"><a href="https://blog.themastergames.com/posts" title="Master Games Blog">Blog</a></li>
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
                © 2020. <a href="https://themastergames.com" title="Master Games Homepage">Master Games</a> All rights
                reserved.
            </p>

            <ul class="footer-menu px-0">
                <li><a href="privacy-policy.html" title="Privacy Policy">Privacy Policy</a></li>
                <li><a href="terms-of-service.html" title="Terms of service">Terms of service</a></li>
            </ul>
        </footer>
        <!-- Footer section end -->
    </div>
</body>

</html>
