<form method="POST" action="{{ route("register.umkmAccount") }}">
  @csrf
  <div class="form-group row">
      <label for="name" class="col-md-4 col-form-label">Nama Lengkap</label>
      <div class="col-md-8">
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ isset($formData['name']) ? $formData['name'] : old('name') }}" required autocomplete="name" autofocus>
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
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ isset($formData['email']) ? $formData['email'] : old('email') }}" required autocomplete="email">
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
      <div class="col-8 col-md-5 offset-md-4">
        <span class="text-muted">
            Sudah Punya Akun? <a href="{{route('login')}}" class="ru-link-base">Login</a>
        </span>
      </div>
        <div class="col-4 col-md-3 text-right">
          <button type="submit" class="btn btn-success btn-sm" title="Klik untuk melanjutkan"><i class="fas fa-arrow-right"></i>&nbsp;Lanjutkan</button>
        </div>
  </div>
  </form>