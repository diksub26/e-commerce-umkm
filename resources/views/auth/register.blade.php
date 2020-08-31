@extends('layouts.public.landing')
@section('title', 'Daftar')

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
                <div class="card-title ru-text-title"><h4><i class="fa fa-user mr-2 mb-2"></i>Register</h4></div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label">Nama Lengkap</label>
                        <div class="col-md-8">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label">Alamat Email</label>
                        <div class="col-md-8">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label">Password</label>
                        <div class="col-md-8">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label">Konfirmasi Password</label>
                        <div class="col-md-8">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-success">Daftar</button>
                            <span class="text-muted">
                                Sudah Punya Akun? <a href="{{route('login')}}" class="ru-link-base">Login</a>
                            </span>
                        </div>
                    </div>
                </form>
              </div>
            </div>
            <div class="mt-2 mt-md-4 text-muted text-center">
              Daftar Sebagai UMKM ?<a href="{{route('register.formAccount')}}" class="ru-link-base ml-1">Daftar disini</a>
            </div>
          </div>
          </div>
        </div>
      </div>
    </main>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('css/landing/auth.css')}}">
@endpush