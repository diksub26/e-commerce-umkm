@extends('layouts.admin')

@section('content-header', 'Update Master Pengiriman')
@section('title', 'Master Pengiriman')

@section('content')
    <div class="row">
        <div class="col-12 col-md-4 offset-md-4">
            <form action="{{ route('masterdata.shipping.update', ['shipping' => $shipping])}}" method="post" id="myForm">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h4>Data Kategori Produk</h4>
                        <hr>
                        <div class="row mb-5">
                            <div class="col-12">
                                <div class="form-group">
                                    @method('patch')
                                    <label for="name" class="form-label">Nama Jenis Pengiriman</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ? old('name') : $shipping->name}}">
                                    @error('name')
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
                                <a href="{{ route('masterdata.shipping.index') }}" class="btn btn-danger mb-2"><i class="fa fa-ban mr-1"></i>Batal</a>
                                <button type="submit" class="btn btn-info mb-2 float-right"><i class="fa fa-check mr-1"></i>Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
<script>
    jQuery(document).ready(function(){
        // Initialize when page loads
        jQuery(function(){ window.beFormValidation('myForm', {
            'name': {
                required: true,
                maxlength: 100
            }
        }).init(); });
    })
</script>
@endpush