@extends('layouts.admin')
@section('content-header', 'Home')
@section('title', 'Home')

@section('content')
    <div class="container">
        <h4>Daftar UMKM</h4>
        <hr>
        <div class="row">
            @forelse ($umkm as $val)
                <div class="col-12 col-md-4 d-flex align-items-stretch">
                    <div class="card card-success">
                        <img src="{{ asset('storage/'.$val->umkm_pic) }}" class="card-img-top" alt="logo-umkm">
                        <div class="card-body">
                            <div class="card-title ru-text-title font-weight-bold">{{ $val->name}}</div>
                            <h6 class="text-dark">Nomor Telepon :</h6>
                            <div class="card-text mb-2">
                                {{ $val->phone != '' ? $val->phone : '-' }}
                            </div>
                            <h6 class="text-dark">Alamat :</h6>
                            <div class="card-text mb-2">
                                {{ isset($val->fullAddress) && $val->fullAddress != '' ? $val->fullAddress : '-'}}
                            </div>
                            <h6 class="text-dark">Deskripsi Usaha :</h6>
                            <div class="card-text">
                                {{ $val->description  ? $val->description : "-"}}
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('showUmkm', ['umkm' => $val->id])}}" class="btn ru-btn-secondary text-light float-right">Lihat Produk <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>Tidak ada data yang ditamplikan.</p>
                </div>
            @endforelse
        </div>
        {{ $umkm->links() }}
    </div>
@endsection
