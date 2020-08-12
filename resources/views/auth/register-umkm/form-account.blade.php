<form class="wizard-content mt-2" method="POST" action="{{ route("register.umkmAccount") }}">
    @csrf
    <div class="wizard-pane">
      <div class="form-group row align-items-center">
        <label class="col-md-4 text-md-right text-left">Nama Lengkap</label>
        <div class="col-lg-4 col-md-6">
          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
          @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>
      <div class="form-group row align-items-center">
        <label class="col-md-4 text-md-right text-left">Alamat Email</label>
        <div class="col-lg-4 col-md-6">
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
          @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>
      <div class="form-group row">
        <label class="col-md-4 text-md-right text-left mt-2">Password</label>
        <div class="col-lg-4 col-md-6">
         <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}">
          @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>
      <div class="form-group row">
        <label class="col-md-4 text-md-right text-left mt-2">Konfirmasi Password</label>
        <div class="col-lg-4 col-md-6">
          <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}">
           @error('password_confirmation')
             <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
             </span>
           @enderror
         </div>
      </div>
      <div class="form-group row">
        <div class="col-md-4"></div>
        <div class="col-lg-4 col-md-6 text-right">
          <button type="submit" class="btn btn-icon icon-right btn-primary">Next <i class="fas fa-arrow-right"></i></button>
        </div>
      </div>
    </div>
  </form>