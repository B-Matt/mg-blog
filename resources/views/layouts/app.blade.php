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
                    <li class="active"><a href="https://themastergames.com/" title="Master Games Website">Home</a></li>
                    <li><a href="https://themastergames.com/products/index" title="Master Games Products">Products</a></li>
                    <li><a href="https://blog.themastergames.com/posts" title="Master Games Blog">Blog</a></li>
                </ul>
            </nav>
        </header>
        <!-- Header section end -->

        <div class="content-section">
            <div class="py-4">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
