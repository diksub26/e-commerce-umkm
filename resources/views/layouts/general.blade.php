<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/img/loader.svg?>/loader.svg" type="image/x-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Title --}}
    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    
    <!-- Scripts -->
    <script src="{{ asset('js/loader.js')}}"></script>
    
    {{-- additional css --}}
    @stack('css')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
</head>
<body>
    <div id="app">
        @yield('content')
    </div>
    <script src="{{ asset('js/app.js')}}"></script>

    {{-- for additional scripts --}}
    @stack('script')
</body>
</html>