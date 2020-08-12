<form class="wizard-content mt-2" method="POST" action="{{ route("register.umkmData") }}">
    @csrf
    <div class="wizard-pane">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="form-group row">
              <label class="col-md-4">Upload Logo UMKM</label>
              <div class="col-md-8">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-6">
            <button class="btn btn-icon icon-right btn-secondary float-left">Back <i class="fas fa-arrow-left"></i></button>
          </div>
          <div class="col-6">
            <button type="submit" class="btn btn-icon icon-right btn-primary float-right">Upload dan Mendaftar <i class="fas fa-save"></i></button>
          </div>
        </div>
      </div>
    </div>
</form>