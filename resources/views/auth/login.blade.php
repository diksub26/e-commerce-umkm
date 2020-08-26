@extends('layouts.public.landing')
@section('title', 'Home')

@section('content')
    <main>
      <div class="container">
        <div class="row">
          <div class="col-12 text-center mb-4">
            <img src="{{asset('img/loader.svg')}}" alt="logo" width="80">
          </div>
          <div class="col-12 offset-md-4 col-md-4">
            <div class="card bg-light">
              
              <div class="card-body">
                <div class="card-title text-center ru-text-title"><h4>Login</h4></div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Alamat Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" tabindex="1" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="d-block">
                            <label for="password" class="control-label">Password</label>
                            @if (Route::has('password.request'))
                                <div class="float-right">
                                    <a href="{{ route('password.request') }}" class="ru-link-base">
                                      <small>Lupa Password ?</small>
                                    </a>
                                </div>
                            @endif
                        </div>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" tabindex="2" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
  
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me" {{ old('remember') ? 'checked' : '' }}>
                      <label class="custom-control-label" for="remember-me">Ingat Saya</label>
                    </div>
                  </div>
  
                  <div class="form-group">
                    <button type="submit" class="btn bg-success text-white btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
  
              </div>
            </div>
            <div class="mt-5 text-muted text-center">
              Belum Punya Akun? <a href="{{route('register')}}" class="ru-link-base">Daftar Sekarang</a>
            </div>
          </div>
          </div>
        </div>
      </div>
    </main>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('css/landing/login.css')}}">
@endpush