@extends('layouts.admin')

@section('title', 'Kelola Kategori Produk')
@section('content-header', 'Edit Data Kategori Produk')

@section('content')
    <div class="row">
        <div class="col-12 col-md-4 offset-md-4">
            <form action="{{ route('masterdata.categoryProduct.update')}}" method="post">
                @csrf
                @method('patch')
                <div class="card">
                    <div class="card-body">
                        <h4>Data Kategori Produk</h4>
                        <hr>
                        <input type="hidden" name="id" value="{{ $categoryProduct->id }}">
                        <div class="row mb-5">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name" class="form-label">Nama Kategori</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ? old('name') : $categoryProduct->name }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                               @if ($categoryProduct->is_parent == false)
                                    <div class="form-group" id="parent-select">
                                        <label for="parent_id">Parent Kategori</label>
                                        <select class="custom-select @error('parent_id') is-invalid @enderror" name="parent_id">
                                            <option disabled>Silahkan Pilih</option>
                                            @foreach ($parent as $val)
                                                <option value="{{ $val->id}}" @if(old('parent_id') == $val->id || $categoryProduct->parent_id == $val->id) selected @endif>{{ $val->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('parent_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                               @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12">
                                <a href="{{ route('masterdata.categoryProduct.index')}}" class="btn btn-danger mb-2"><i class="fa fa-ban mr-1"></i>Batal</a>
                                <button type="submit" class="btn btn-primary mb-2 float-right"><i class="fa fa-save mr-1"></i>Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection