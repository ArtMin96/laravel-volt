<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/admin.js') }}" defer></script>

    <!-- Vendor JS -->
    <script src="{{ asset('assets/js/on-screen.umd.min.js') }}"></script>

    <!-- Slider -->
    <script src="{{ asset('assets/js/nouislider.min.js') }}"></script>

    <!-- Smooth scroll -->
    <script src="{{ asset('assets/js/smooth-scroll.polyfills.min.js') }}"></script>

    <!-- Apex Charts -->
    <script src="{{ asset('vendor/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Charts -->
    <script src="{{ asset('assets/js/chartist.min.js') }}"></script>
    <script src="{{ asset('assets/js/chartist-plugin-tooltip.min.js') }}"></script>

    <!-- Sweet Alerts 2 -->
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>

    <!-- Moment JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

    <!-- Notyf -->
    <script src="{{ asset('vendor/notyf/notyf.min.js') }}"></script>

    <!-- Simplebar -->
    <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script src="{{ asset('assets/js/volt.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
{{--    <link href="{{ asset('css/volt.css') }}" rel="stylesheet">--}}

    @livewireStyles

    @stack('styles')
</head>
<body>

    @include('layouts.nav')

    @livewire('admin.layouts.sidebar')
{{--    @include('layouts.sidenav')--}}

    <main class="content">

        @include('layouts.topbar')

        @yield('content')

        @isset($slot)
            {{ $slot }}
        @endisset
    </main>

    @stack('modals')

    @livewireScripts

    @stack('scripts')
</body>
</html>
