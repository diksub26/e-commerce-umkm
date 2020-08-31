<form method="POST" action="{{ route("register.umkmData") }}">
    @csrf
    <div class="form-group row">
      <label class="col-md-4">Nama UMKM</label>
      <div class="col-md-8">
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ isset($formData['name']) ? $formData['name'] : old('name') }}">
        @error('name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label class="col-md-4">No. Telp/Handphone</label>
      <div class="col-md-8">
        <input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" value="{{ isset($formData['no_telp']) ? $formData['no_telp'] : old('no_telp') }}">
        @error('no_telp')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label class="col-md-4">Dekripsi Usaha</label>
      <div class="col-md-8">
        <textarea name="description" style="height:100px" class="form-control @error('description') is-invalid @enderror" value="{{ isset($formData['description']) ? $formData['description'] : old('description') }}">{{ isset($formData['description']) ? $formData['description'] : old('description') }}</textarea>
        @error('description')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label class="col-md-4">Alamat Usaha</label>
      <div class="col-md-8">
        <textarea name="address" style="height:100px" class="form-control @error('address') is-invalid @enderror" value="{{ isset($formData['address']) ? $formData['address'] : old('address') }}">{{ isset($formData['address']) ? $formData['address'] : old('address') }}</textarea>
        @error('address')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label class="col-md-4">Provinsi</label>
      <div class="col-md-8">
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
    <div class="form-group row">
      <label class="col-md-4">Kabupaten/Kota</label>
      <div class="col-md-8">
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
    <div class="form-group row">
      <label class="col-md-4">Kecamatan</label>
      <div class="col-md-8">
        <select name="district_id" class="form-control select2">
            <option value=""></option>
        </select>
        @error('district_id')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label class="col-md-4">Kelurahan</label>
      <div class="col-md-8">
        <select name="village_id" class="form-control select2">
            <option value=""></option>
        </select>
        @error('village_id')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label class="col-md-4">Kode Pos</label>
      <div class="col-md-8">
        <input type="text" name="postal_code" class="form-control @error('postal_code') is-invalid @enderror" value="{{ isset($formData['postal_code']) ? $formData['postal_code'] : old('postal_code') }}">
        @error('postal_code')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <div class="col-6">
        <a class="btn btn-icon icon-right btn-secondary float-left" href="{{ route('register.formAccount')}}">Kembali <i class="fas fa-arrow-left"></i></a>
      </div>
      <div class="col-6 text-right">
        <button type="submit" class="btn btn-success" title="Klik untuk melanjutkan"><i class="fas fa-arrow-right"></i>&nbsp;Lanjutkan</button>
      </div>
    </div>
</form>

@push('script')
    <script src="{{ config('my_config.assets.js.select2')}}"></script>
    <script>
        $(document).ready(function(){
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

            $('select[name="city_id"]').on('change', function(){
                $.ajax({
                    url: '{{ route("getDistricts") }}?id=' + $(this).val(),
                    type: 'GET',
                    beforeSend: function(xhr) {
                        $('select[name="district_id"]').html('');
                        $('select[name="district_id"]').val('').trigger('change');
                    },
                    error: function() {
                        alert('An error has occurred');
                    },
                    success: function(data) {
                        $('select[name="district_id"]').select2({
                            placeholder: 'Silahkan Pilih',
                            allowClear :true,
                            data: data
                        });
                        $('select[name="district_id"]').val("{{ isset($formData['district_id']) ? $formData['district_id'] : old('district_id') }}").trigger('change')
                    },
                });
            });

            $('select[name="district_id"]').on('change', function(){
                $.ajax({
                    url: '{{ route("getVillages") }}?id=' + $(this).val(),
                    type: 'GET',
                    beforeSend: function(xhr) {
                        $('select[name="village_id"]').html('');
                        $('select[name="village_id"]').val('').trigger('change');
                    },
                    error: function() {
                        alert('An error has occurred');
                    },
                    success: function(data) {
                        $('select[name="village_id"]').select2({
                            placeholder: 'Silahkan Pilih',
                            allowClear :true,
                            data: data
                        })
                        $('select[name="village_id"]').val("{{ isset($formData['village_id']) ? $formData['village_id'] : old('village_id') }}").trigger('change')
                    },
                });
            });
        })
    </script>
@endpush
@push('css')
    <link rel="stylesheet" href="{{ config('my_config.assets.css.select2')}}">
@endpush