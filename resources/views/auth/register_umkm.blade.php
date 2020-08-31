@extends('layouts.public.landing')
@section('title', 'Daftar Sebagai UMKM')

@section('content')
    <main>
      <div class="container">
        <div class="row">
          <div class="col-12 text-center mb-4">
            <img src="{{asset('img/loader.svg')}}" alt="logo" width="80">
          </div>
          <div class="col-12 offset-md-3 col-md-6">
            <div class="card bg-light">
              <div class="card-body">
                  @switch($activeForm)
                      @case('umkm_account')
                          <div class="card-title ru-text-title"><h4><i class="fa fa-user mr-2 mb-2"></i>Data Akun Pengguna</h4></div>
                          @include('auth.register-umkm.form-account')
                          @break
                      @case('umkm_detail')
                        <div class="card-title ru-text-title"><h4><i class="fas fa-store mr-2 mb-2"></i>Detail UMKM</h4></div>
                        @include('auth.register-umkm.form-umkm')
                          @break
                      @case('umkm_picture')
                        <div class="card-title ru-text-title"><h4><i class="fas fa-image mr-2 mb-2"></i>Logo UMKM</h4></div>
                        @include('auth.register-umkm.form-picture')
                        @break
                      @case('umkm_finish')
                        <div class="card-title ru-text-title"><h4><i class="fa fa-check-circle mr-2 mb-2"></i>Berhasil</h4></div>
                        @include('auth.register-umkm.finish')
                        @break
                  @endswitch
              </div>
            </div>
            <div class="mt-2 mt-md-4 text-muted text-center">
              Daftar Sebagai Reseller ?<a href="{{route('register')}}" class="ru-link-base ml-1">Daftar disini</a>
            </div>
          </div>
        </div>
      </div>
    </main>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('css/landing/auth.css')}}">
@endpush