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
    <link rel="icon" type="image/png" href="{{ isset($settings) == true ? $settings->icon_fav : '' }}" />
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
    @yield('extra-css')
    <!-- END Styles -->
</head>

<body>
    <div id="dash-wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
                <div class="sidebar-brand-text mx-3">{{ $settings->short_title }} {{ __('main.dashboard') }}</div>
            </a>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('dash.index') }}">
                    <i class="dash-icon flaticon-browser"></i>
                    <span>{{ __('main.dashboard') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="dash-icon flaticon-chat"></i>
                    <span>{{ __('main.posts') }}</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="collapse-inner">
                        <a class="collapse-item" href="{{ route('dash.posts') }}">{{ __('main.post_all') }}</a>
                        <a class="collapse-item" href="{{ route('dash.create') }}">{{ __('main.post_create') }}</a>
                        <a class="collapse-item" href="{{ route('categories.index') }}">{{ __('main.categories') }}</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="dash-icon flaticon-user"></i>
                    <span>{{ __('main.users') }}</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="py-2 collapse-inner">
                        <a class="collapse-item" href="{{ route('users.index') }}">{{ __('main.all_users') }}</a>
                        <a class="collapse-item" href="{{ route('users.create') }}">{{ __('main.create_user') }}</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="dash-icon flaticon-settings"></i>
                    <span>{{ __('main.settings') }}</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 collapse-inner">
                        <a class="collapse-item" href="{{ route('settings.index') }}">{{ __('main.general') }}</a>
                        <a class="collapse-item" href="{{ route('settings.mobile') }}">{{ __('main.mobile') }}</a>
                        <a class="collapse-item" href="{{ route('settings.social') }}">{{ __('main.social') }}</a>
                    </div>
                </div>
            </li>
        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column w-100">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="dash-icon flaticon-menu"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle" src="{{ Auth::user()->avatar }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>

    <script src="{{ asset('/js/jquery.slim.min.js') }}"></script>
    @yield('extra-js')
    @yield('js-code')

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
