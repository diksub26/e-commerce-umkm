@extends('layouts.admin')

@section('content-header', 'Tambah Master Ongkir')
@section('title', 'Master Ongkir')

@push('styles')
    <link rel="stylesheet" href="{{ config('my_config.assets.css.select2')}}">
@endpush

@section('content')
    <div class="row">
        <div class="col-12 col-md-4 offset-md-4">
            <form action="{{ route('masterdata.ongkir.store')}}" method="post" id="myForm">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h4>Data Ongkir</h4>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="shipping_id" class="form-label">Pilih Master Pengiriman</label>
                                    <select name="shipping_id" class="form-control select2">
                                        {!! $shipping !!}
                                    </select>
                                    @error('shipping_id')
                                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="province_id" class="form-label">Provinsi</label>
                                    <select name="province_id" class="form-control select2">
                                        <option value=""></option>
                                    </select>
                                    @error('province_id')
                                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="city_id" class="form-label">Kab/Kota</label>
                                    <select name="city_id" class="form-control select2">
                                        <option value=""></option>
                                    </select>
                                    @error('city_id')
                                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="ongkir" class="form-label">Ongkir Per Kg</label>
                                    <input type="number" class="form-control @error('ongkir') is-invalid @enderror" name="ongkir" value="{{ old('ongkir')}}" placeholder="Ongkir Per Kg">
                                    @error('ongkir')
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
                                <button type="submit" class="btn btn-success mb-2 float-right"><i class="fa fa-save mr-1"></i>Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
<script src="{{ config('my_config.assets.js.select2')}}"></script>
<script>
    jQuery(document).ready(function(){
        $('.select2').select2({
            placeholder: 'Silahkan Pilih',
            allowClear: true
        })

        $.ajax({
            url: '{{ route("getProvinces") }}',
            type: 'GET',
            error: function() {
                // alert('An error has occurred');
            },
            success: function(data) {
                $('select[name="province_id"]').select2({
                    placeholder: 'Silahkan Pilih',
                    allowClear :true,
                    data: data
                });
                $('select[name="province_id"]').val("{{ isset($formData['province_id']) ? $formData['province_id'] : old('province_id') }}").trigger('change')
            },
        });
            
        $('select[name="province_id"]').on('change', function(){
            $.ajax({
                url: '{{ route("getCities") }}?id=' + $(this).val(),
                type: 'GET',
                beforeSend: function(xhr) {
                    $('select[name="city_id"]').html('');
                    $('select[name="city_id"]').val('').trigger('change');
                },
                error: function() {
                    alert('An error has occurred');
                },
                success: function(data) {
                    $('select[name="city_id"]').select2({
                        placeholder: 'Silahkan Pilih',
                        allowClear :true,
                        data: data
                    });
                    $('select[name="city_id"]').val("{{ isset($formData['city_id']) ? $formData['city_id'] : old('city_id') }}").trigger('change')
                },
            });
        });

        // Initialize when page loads
        jQuery(function(){ window.beFormValidation('myForm', {
            'shipping_id': {
                required: true,
            },
            'province_id': {
                required: true,
            },
            'city_id': {
                required: true,
            },
            'ongkir': {
                required: true,
            }
        }).init(); });
    })
</script>
@endpush