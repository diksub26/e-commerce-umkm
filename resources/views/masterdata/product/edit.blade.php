@extends('layouts.admin')

@section('content-header', 'Tambah Data Produk')
@section('title', 'Edit Data Produk')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{route('masterdata.product.update', ['product' => $product])}}" method="POST" id="myForm">
                    <div class="card-body">
                        <h4>Data Produk</h4>
                        @csrf
                        @method('patch')
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="name">Nama Produk</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ? old('name') : $product->name }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="price">Harga Jual</label>
                                    <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') ?  old('price') : $product->price }}">
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category">Kategori</label>
                                    <select id="category" name="category" class="custom-select @error('category') is-invalid @enderror">
                                        {!! $categoryList !!}
                                    </select>
                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="size">Ukuran (Dapat dikosongkan)</label>
                                    <input type="text" class="form-control @error('size') is-invalid @enderror" name="size" value="{{ old('size') ? old('size') : $product->size }}">
                                    @error('size')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <textarea class="form-control form-control-sm @error('description') is-invalid @enderror" rows="5" name="description" value="{{ old('description') ? old('description') : $product->description }}">{{ old('description') ? old('description') : $product->description }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="unit_weight">Satuan Berat</label>
                                    <select class="custom-select @error('unit_weight') is-invalid @enderror" name="unit_weight" value="{{ old('unit_weight') }}">
                                        @foreach (config('my_config.satuan_berat.code') as $key => $item)
                                            <option value="{{ $item }}" @if($item == old('unit_weight') || $item == $product->unit_weight ) selected @endif>{{ $key }}</option>
                                        @endforeach
                                    </select>
                                    @error('unit_weight')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="weight">Berat</label>
                                    <input type="text" class="form-control  @error('weight') is-invalid @enderror" name="weight" value="{{ old('weight') ? old('weight') : $product->weight }}">
                                    @error('weight')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12">
                                <a href="{{ route('masterdata.product.index') }}" class="btn btn-danger mb-2"><i class="fa fa-ban mr-1"></i>Batal</a>
                                <button type="submit" class="btn btn-info mb-2 float-right"><i class="fa fa-check mr-1"></i>Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
    jQuery(document).ready(function(){
        $('#category').val({{old('category') ? old('category') : $product->category }});
        // Initialize when page loads
        jQuery(function(){ window.beFormValidation('myForm', {
            'name': {
                required: true,
                maxlength: 100
            },
            'price' :{
                required: true,
                digits: true
            },
            'size' :{
                maxlength: 75
            },
            'category': {
                required: true
            },
            'description' :{
                required: true,
                maxlength: 250
            },
            'unit_weight' :{
                required: true
            },
            'weight' :{
                required: true,
                digits: true
            }
        }).init(); });
    })
</script>
@endpush