@extends('layouts.general')

@section('title', 'Register UMKM')
@section('content')
<section class="section">
  <div class="container mt-5">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>Register sebagai UMKM</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12 col-lg-8 offset-lg-2">
                <div class="wizard-steps">
                  <div class="wizard-step wizard-step-active">
                    <div class="wizard-step-icon">
                      <i class="fas fa-user"></i>
                    </div>
                    <div class="wizard-step-label">
                      Akun Pengguna
                    </div>
                  </div>
                  <div class="wizard-step @if(in_array('umkm_detail', $activeWizard)) wizard-step-active  @endif">
                    <div class="wizard-step-icon">
                      <i class="fas fa-store"></i>
                    </div>
                    <div class="wizard-step-label">
                      Data UMKM
                    </div>
                  </div>
                  <div class="wizard-step @if(in_array('umkm_picture', $activeWizard)) wizard-step-active  @endif">
                    <div class="wizard-step-icon">
                      <i class="fas fa-image"></i>
                    </div>
                    <div class="wizard-step-label">
                     Logo UMKM
                    </div>
                  </div>
                  <div class="wizard-step">
                    <div class="wizard-step-icon">
                      <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="wizard-step-label">
                     Success
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @switch($activeForm)
                @case('umkm_detail')
                  @include('auth/register-umkm/form-umkm')
                  @break
                @case('umkm_picture')
                  @include('auth/register-umkm/form-picture')
                    @break
                @default
                  @include('auth/register-umkm/form-account')
            @endswitch
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
         
@endsection