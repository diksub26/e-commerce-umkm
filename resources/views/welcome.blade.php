@extends('layouts.public.landing')

@section('title', 'Home')
   
@section('content')
  <header>
      <div class="jumbotron  jumbotron-custom">
        <h1 class="display-3 font-weight-bold">ROKET UMKM</h1>
        <h3 style="margin-top:24px ">Meroket bersama UMKM Indonesia..</h3>
        <p class="lead">Yuk tambah penghasilanmu,<br>
          dengan menjadi reseller dari berbagai UMKM yang terdaftar disini,<br>
          berbisnis sambil memajukan negeri, disinilah tempatnya.                
      </p>
        <a class="btn btn-success btn-lg" href="{{ route('register') }}" role="button">Daftar Sekarang</a>
      </div>
  </header>
  <main>
     <section id="define-section">
         <div class="container pb-4">
              <div class="row">
                  <div class="col-12 text-center">
                      <h1><img src="{{asset('img/loader.svg')}}" alt="logo" width="50" class="mr-2"></h1>
                      <blockquote class="blockquote text-center pt-4">
                          <p class="mb-0">"Roket UMKM Merupakan sebuah <em>E-Marketplace</em> dengan proses bisnis B2B, <br>
                              yang memfasilitasi UMKM Indonesia untuk dapat memasarkan produknya, dan menghubungkan UMKM dengan <em>Reseller-reseller</em>."
                          </p>
                          <footer class="blockquote-footer">Founder Roket UMKM</footer>
                        </blockquote>
                  </div>
              </div>
         </div>
     </section>
     <section id="our-features">
          <div class="container pb-4">
              <div class="row mb-4">
                  <div class="col-12 text-center">
                      <h1 class="text-white">Our Features</h1>
              </div>
              </div>
              <div class="row">
                  <div class="col-12 col-md-4">
                      <div class="card text-center mb-2">
                          <div class="card-body">
                            <h5 class="card-title mb-4 font-weight-bold">UMKM yang tervalidasi</h5>
                            <p class="card-text">Hanya UMKM yang telah tervalidasi yang menjual produknya disini, sehingga produk yang dijual adalah produk unggulan.</p>
                          </div>
                        </div>
                  </div>
                  <div class="col-12 col-md-4">
                      <div class="card text-center mb-2">
                          <div class="card-body">
                            <h5 class="card-title mb-4 font-weight-bold">B2B</h5>
                            <p class="card-text">Proses Bisnis dalam Website ini menggunakan <em>Business To Business</em> dimana sangat mendukung bagi <em>Reseller</em> yang membutuhkan produk dari UMKM yang <em>Open reseller</em></p>
                          </div>
                        </div>
                  </div>
                  <div class="col-12 col-md-4">
                      <div class="card text-center mb-2">
                          <div class="card-body">
                            <h5 class="card-title mb-4 font-weight-bold">Kenyamanan Bertransaksi</h5>
                            <p class="card-text">Segala fitur yang dibuat dalam website, dibuat untuk memberikan kenyamanan bertransaki baik itu untuk UMKM maupun untuk <em>Reseller</em></p>
                          </div>
                        </div>
                  </div>
              </div>
          </div>
     </section>
  </main>
@endsection

@push('css')
  <link rel="stylesheet" href="{{ asset('css/landing/home.css') }}">
@endpush
      
