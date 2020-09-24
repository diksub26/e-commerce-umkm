@extends('layouts.admin')
@section('content-header', 'Produk UMKM')
@section('title', 'Produk UMKM')

@section('content')
    <div class="container">
        <h4>Profil UMKM</h4>
        <hr>
        <div class="row">
            <div class="col-12">
                <div class="card card-success">
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-4">
                                    <img src="{{ asset('storage/'.$umkm->umkm_pic) }}" class="card-img" alt="logo-umkm">
                                </div>
                                <div class="col-8">
                                    <h2 class="card-title ru-text-title font-weight-bold">{{ $umkm->name}}</h2>
                                    <h6 class="text-dark">Nomor Telepon :</h6>
                                    <div class="card-text mb-2">
                                        {{ $umkm->phone != '' ? $umkm->phone : '-' }}
                                    </div>
                                    <h6 class="text-dark">Alamat :</h6>
                                    <div class="card-text mb-2">
                                        {{ isset($umkm->fullAddress) && $umkm->fullAddress != '' ? $umkm->fullAddress : '-'}}
                                    </div>
                                    <h6 class="text-dark">Deskripsi Usaha :</h6>
                                    <div class="card-text">
                                        {{ $umkm->description  ? $umkm->description : "-"}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h4>Produk</h4>
        <hr>
    </div>
@endsection
