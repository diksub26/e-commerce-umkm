@extends('layouts.admin')

@section('content-header', 'Tambah Data Kategori Produk')

@section('content')
    <div class="row">
        <div class="col-12 col-sm-4 offset-md-4">
            <div class="card">
                <div class="card-body">
                    <h4>Data Kategori Produk</h4>
                    <hr>
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Nama Kategori</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" id="defaultCheck1">
                                  <label class="form-check-label" for="defaultCheck1">
                                    Parent Kategori
                                  </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Parent Kategori</label>
                                <select class="custom-select">
                                    <option>Option 1</option>
                                    <option>Option 2</option>
                                    <option>Option 3</option>
                                    <option>Option 3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-danger mb-2"><i class="fa fa-ban mr-1"></i>Batal</button>
                            <button class="btn btn-success mb-2 float-right"><i class="fa fa-save mr-1"></i>Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection