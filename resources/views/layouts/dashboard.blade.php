<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <!-- START General Info -->
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="canonical" href="{{ URL::current() }}" />
    <link rel="alternate" href="{{ URL::current() }}" hreflang="{{ str_replace('_', '-', app()->getLocale()) }}" />

    <title>{!! isset($settings) == true ? $settings->title : config('app.name', 'Laravel') !!} Dashboard</title>
    <meta name="description" content="{{ isset($settings) == true ? $settings->description : '' }}" />
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="theme-color" content="{{ isset($settings) == true ? $settings->theme_color : '' }}" />
    <link rel="shortcut icon" href="{{ isset($settings) == true ? $settings->icon_fav : '' }}" />
    <link rel="apple-touch-icon" href="{{ isset($settings) == true ? $settings->icon_apple : '' }}" />
    <meta name="robots" content="index, follow">
    <!-- END General Info -->

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
        <nav class="navbar dash-nav navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <nav class="col d-md-block bg-light dash-sidebar">
                    <a class="navbar-brand navbar-light bg-white shadow-sm w-100 text-center" href="{{ url('/') }}">
                        {{ $settings->title }}
                    </a>
                    <div class="dash-sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('dash.index') }}">
                                    <i class="dash-icon flaticon-browser"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <button type="button" class="btn btn-link dropdown-toggle w-100 text-left"
                                    data-toggle="dropdown">
                                    <i class="dash-icon flaticon-chat"></i>
                                    <span>Posts</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('dash.posts') }}">All Posts</a>
                                    <a class="dropdown-item" href="{{ route('dash.create') }}">Create Post</a>
                                </div>
                            </li>
                            <li class="dropdown">
                                <button type="button" class="btn btn-link dropdown-toggle w-100 text-left"
                                    data-toggle="dropdown">
                                    <i class="dash-icon flaticon-user"></i>
                                    <span>Users</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('users.index') }}">All Users</a>
                                    <a class="dropdown-item" href="{{ route('users.create') }}">Create User</a>
                                </div>
                            </li>
                            <li class="dropdown">
                                <button type="button" class="btn btn-link dropdown-toggle w-100 text-left"
                                    data-toggle="dropdown">
                                    <i class="dash-icon flaticon-settings"></i>
                                    <span>Settings</span>
                                </button>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('settings.index') }}">General</a>
                                    <a class="dropdown-item" href="{{ route('users.index') }}">SEO</a>
                                    <a class="dropdown-item" href="{{ route('users.index') }}">Ads</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <main class="offset-md-2 col pr-5 pt-4">
                    @hasSection('notification')
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        @yield('notification')
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif                    
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>

</html>
