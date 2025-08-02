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
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    <meta name="description" content="API Services BPR Bangunarta menyediakan integrasi cepat dan aman untuk layanan perbankan digital yang andal dan efisien.">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ env('APP_NAME') }}: @yield('title')">
    <meta property="og:description" content="API Services BPR Bangunarta menyediakan integrasi cepat dan aman untuk layanan perbankan digital yang andal dan efisien.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('logo.png') }}">
    <meta property="og:site_name" content="{{ env('APP_NAME') }}: @yield('title')">

    <!-- CSS files -->
    <link href="{{ asset('dist/css/tabler.css?1744816591') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-flags.css?1744816591') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-socials.css?1744816591') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-payments.css?1744816591') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-vendors.css?1744816591') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-marketing.css?1744816591') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-themes.css?1744816591') }}" rel="stylesheet" />
    <link href="{{ asset('preview/css/demo.css?1744816591') }}') }}" rel="stylesheet" />
    <style>
        @import url("https://rsms.me/inter/inter.css");

        .text-justify {
            text-align: justify;
        }
    </style>
</head>

<body>
    <script src="{{ asset('dist/js/tabler-theme.min.js?1744816591') }}"></script>

    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <div class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <a><img class="navbar-brand-image" src="{{ asset('logo_full.svg') }}" alt="logo"></a>
                </div>
            </div>

            @yield('page-body')
        </div>
    </div>

    <!-- theme -->
    @include('layouts.theme')

    <!-- JS files -->
    <script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>
    <script src="{{ asset('preview/js/demo.min.js') }}" defer></script>

    <!-- JS Pages -->
    @stack('js')
</body>

</html>