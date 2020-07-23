@extends('layouts.general')

@section('content')
<section class="section">
    <div class="container mt-5">
      <div class="page-error">
        <div class="page-inner">
          <h1>@yield('code')</h1>
          <div class="page-description">
              @yield('message')
          </div>
          <div class="page-search">
            <div class="mt-3">
              <a href="{{ url('/home') }}">Back to Home</a>
            </div>
          </div>
        </div>
      </div>
      <div class="simple-footer">
        Copyright &copy; {{ env('APP_NAME')}} 2020
      </div>
    </div>
  </section>
@endsection
