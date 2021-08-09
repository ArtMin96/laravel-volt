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

    <!-- Vendor JS -->
    <script src="{{ asset('assets/js/on-screen.umd.min.js') }}"></script>

    <!-- Slider -->
    <script src="{{ asset('assets/js/nouislider.min.js') }}"></script>

    <!-- Smooth scroll -->
    <script src="{{ asset('assets/js/smooth-scroll.polyfills.min.js') }}"></script>

    <!-- Sweet Alerts 2 -->
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>

    <script src="{{ asset('assets/js/volt.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/volt.css') }}" rel="stylesheet">

    @livewireStyles

    @stack('styles')
</head>
<body>
    <main>
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
