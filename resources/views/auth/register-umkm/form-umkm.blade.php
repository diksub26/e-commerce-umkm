<form class="wizard-content mt-2" method="POST" action="{{ route("register.umkmData") }}">
    @csrf
    <div class="wizard-pane">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="form-group row">
              <label class="col-md-4">Nama UMKM</label>
              <div class="col-md-8">
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-4">Dekripsi Usaha</label>
              <div class="col-md-8">
                <textarea name="description" style="height:100px" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}">{{ old('description') }}</textarea>
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
                <textarea name="address" style="height:100px" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}">{{ old('address') }}</textarea>
                @error('address')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6">
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
                <input type="text" name="postal_code" class="form-control @error('postal_code') is-invalid @enderror" value="{{ old('postal_code') }}">
                @error('postal_code')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <button class="btn btn-icon icon-right btn-secondary float-left">Back <i class="fas fa-arrow-left"></i></button>
          </div>
          <div class="col-6">
            <button type="submit" class="btn btn-icon icon-right btn-primary float-right">Next <i class="fas fa-arrow-right"></i></button>
          </div>
        </div>
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
                        }).trigger('change');
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
                        }).trigger('change');
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
                        }).trigger('change');
                    },
                });
            });
        })
    </script>
@endpush
@push('css')
    <link rel="stylesheet" href="{{ config('my_config.assets.css.select2')}}">
@endpush