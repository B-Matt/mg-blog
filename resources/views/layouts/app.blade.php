<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- START General Info -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="canonical" href="{{ URL::current() }}" />
    <link rel="alternate" href="{{ URL::current() }}" hreflang="{{ str_replace('_', '-', app()->getLocale()) }}" />

    <title>{!! isset($post) == true ? ($post->title . ' &bull;') : '' !!} {!! isset($settings) == true ? $settings->short_title : config('app.name', 'Laravel') !!}</title>
    <meta name="description" content="{{ isset($settings) == true ? $settings->description : '' }}" />
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="theme-color" content="{{ isset($settings) == true ? $settings->theme_color : '' }}" />
    <link rel="shortcut icon" href="{{ isset($settings) == true ? $settings->icon_fav : '' }}" />
    <link rel="apple-touch-icon" href="{{ isset($settings) == true ? $settings->icon_apple : '' }}" />
    <meta name="robots" content="index, follow">
    <!-- END General Info -->

    <!-- START Social Graphs -->
    <meta property="og:locale" content="en_US" />
    <meta property="og:title" content="{{ isset($post) == true ? $post->title : config('app.name', 'Laravel') }}" />
    <meta property="og:site_name" content="{{ isset($settings) == true ? $settings->title : config('app.name', 'Laravel') }}" />
    <meta property="og:url" content="{{ URL::current() }}" />
    <meta property="og:description" content="{{ isset($post) == true ? $post->summary : '' }}" /> <!-- Zbugan summary moram nekako maknuti html formating -->
    <meta property="og:type" content="article" />
    <meta property="og:image" content="{{ isset($post) == true ? $post->cover_img : '' }}" />
    <meta property="og:image:secure_url" content="{{ isset($post) == true ? $post->cover_img : '' }}" />
    <meta property="article:publisher" content="https://www.facebook.com/{{ isset($settings) == true ? $settings->profile_facebook : '' }}" />
    <meta property="article:tag" content="ecommerce agency" />
    <meta property="article:tag" content="ecommerce consulting" />
    <meta property="article:tag" content="ecommerce development" />
    <meta property="article:tag" content="eCommerce project" />
    <meta property="article:tag" content="starting ecommerce project" />
    <meta property="article:section" content="eCommerce Talk" />
    <meta property="article:published_time" content="{{ isset($post) == true ? $post->create_time() : '' }}" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="{{ isset($post) == true ? $post->summary : '' }}" /> <!-- Zbugan summary moram nekako maknuti html formating -->
    <meta name="twitter:title" content="{{ isset($post) == true ? $post->title : config('app.name', 'Laravel') }}" />
    <meta name="twitter:site" content="@{{ isset($settings) == true ? $settings->profile_twitter : '' }}" />
    <meta name="twitter:image" content="{{ isset($post) == true ? $post->cover_img : '' }}" />
    <meta name="twitter:creator" content="@{{ isset($user) == true ? $post->cover_img : '' }}" />
    <!-- END Social Graphs -->

    <!-- START JSON-LD -->
    {{ Breadcrumbs::view('breadcrumbs::json-ld', 'post', $post) }}
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
