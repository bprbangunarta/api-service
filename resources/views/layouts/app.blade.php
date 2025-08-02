<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <title>{{ env('APP_NAME') }}: @yield('title')</title>
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/png">
    <meta name="description" content="{{ Str::title('saving mobile bangunarta adalah sistem yang dibangun untuk memudahkan nasabah dalam transaksi.') }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ env('APP_NAME') }}: @yield('title')">
    <meta property="og:description" content="{{ Str::title('saving mobile bangunarta adalah sistem yang dibangun untuk memudahkan nasabah dalam transaksi.') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('logo.png') }}">
    <meta property="og:site_name" content="{{ env('APP_NAME') }}: @yield('title')">

    <!-- CSS files -->
    @include('layouts.header')
</head>

<body>
    <script src="{{ asset('dist/js/tabler-theme.min.js?1744816593') }}"></script>

    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>

    <div class="page">
        <div class="sticky-top">
            <header class="navbar navbar-expand-md sticky-top d-print-none">
                <div class="container-xl">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                        <a href="/">
                            <img class="navbar-brand-image" src="{{ asset('logo_full.svg') }}" alt="logo">
                        </a>
                    </div>

                    <div class="navbar-nav flex-row order-md-last">
                        <div class="nav-item dropdown">
                            <a class="nav-link d-flex lh-1 p-0 px-2" data-bs-toggle="dropdown" aria-label="Open user menu">
                                <span class="avatar avatar-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                        <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                        <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                                    </svg>
                                </span>
                                <div class="d-none d-xl-block ps-2">
                                    <div>{{ Str::title(session('user.name')) }}</div>
                                    <div class="mt-1 small text-secondary">{{ Str::limit(session('user.email'), 15) }}</div>
                                </div>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <small class="text-secondary dropdown-item disable-click">Manage Account</small>
                                <a href="{{ route('profile.index') }}" class="dropdown-item">Profile</a>
                                <div class="dropdown-divider"></div>

                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <header class="navbar-expand-md">
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <div class="navbar">
                        <div class="container-xl">
                            <div class="row flex-column flex-md-row flex-fill align-items-center">
                                <div class="col">
                                    <ul class="navbar-nav">
                                        @include('layouts.menu')
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        </div>

        <div class="page-wrapper">
            <!-- page header -->
            @yield('page-header')

            <!-- page body -->
            @yield('page-body')

            <!--  footer  -->
            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <!-- menu -->
                </div>
            </footer>
        </div>
    </div>

    <!-- theme -->
    @include('layouts.theme')

    @if(session('success') || session('error'))
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div class="toast show" id="toast-simple" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
            <div class="toast-header
            @if(session('success')) bg-success text-white
            @elseif(session('error')) bg-danger text-white
            @endif">
                <strong class="me-auto">Notification</strong>
                <small>Now</small>
                <button type="button" class="btn-close btn-close-white ms-2" aria-label="Close" id="toast-close-btn"></button>
            </div>
            <div class="toast-body">
                {{ session('success') ?? session('error') }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toast = document.getElementById('toast-simple');
            var closeBtn = document.getElementById('toast-close-btn');

            toast.classList.add('show');
            toast.style.opacity = 1;

            closeBtn.addEventListener('click', function() {
                // animasi fade out
                toast.style.transition = 'opacity 0.5s ease';
                toast.style.opacity = 0;
                setTimeout(function() {
                    toast.classList.remove('show');
                    toast.style.display = 'none';
                }, 500);
            });

            setTimeout(function() {
                if (toast.style.opacity == 1) {
                    toast.style.transition = 'opacity 0.5s ease';
                    toast.style.opacity = 0;
                    setTimeout(function() {
                        toast.classList.remove('show');
                        toast.style.display = 'none';
                    }, 500);
                }
            }, 10000);
        });
    </script>
    @endif

    <!-- JS files -->
    @include('layouts.footer')
</body>

</html>