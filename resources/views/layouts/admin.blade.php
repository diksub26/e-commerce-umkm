<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/img/loader.svg?>/loader.svg" type="image/x-icon">

    {{-- Csrf Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Scripts --}}
    <script src="{{ asset('js/loader.js') }}"></script>

    {{-- Fonts --}}
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- Styles --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Custom Styles From Child --}}
    @yield('styles')
</head>
<body>
    <div id="app">
        <div class="main-wrapper">
            {{-- Navbar --}}
            @include('layouts.admin-asset.navbar')

            {{-- Sidebar --}}
            @include('layouts.admin-asset.sidebar')
      
            <div class="main-content">
              <section class="section">
                
                {{-- Content Header --}}
                <div class="section-header">
                  <h1>@yield('content-header')</h1>
                </div>

                 {{-- Content --}}
                <div class="section-body">
                    @yield('content')
                </div>
              </section>
            </div>

            {{-- Footer --}}
            @include('layouts.admin-asset.footer')

          </div>
    </div>

    {{-- script --}}
    <script src="{{ asset('js/app.js') }}"></script>

    {{-- custom script from child--}}
    @yield('script')

</body>
</html>