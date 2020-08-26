<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        {{-- meta --}}
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, shrink-to-fit=no">
        <link rel="icon" href="/img/loader.svg?>/loader.svg" type="image/x-icon">
        @stack('meta')
        
        {{-- title --}}
        <title>@yield('title'){{ " | " . config('app.name', 'Laravel') }}</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Script --}}
        <script src="{{ asset('js/core-public.js') }}"></script>

        {{-- Fonts --}}
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        {{-- Styles --}}
        <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
        @stack('css')
    </head>
    <body>
        {{-- navbar --}}
        @include('layouts/public/landing-asset/navbar')
        {{-- content --}}
        @yield('content')
        {{-- footer --}}
        @include('layouts/public/landing-asset/footer')
        {{-- script --}}
        <script>
            $(function () {
              $(window).scroll(function(){
                var scroll = $(window).scrollTop();
                  if (scroll > 40) {
                    $(".navbar").addClass("navbar__scroll");
                  }else{
                    $(".navbar").removeClass("navbar__scroll");
                 }
              })
            });
        </script>
        @stack('script')
    </body>
</html>