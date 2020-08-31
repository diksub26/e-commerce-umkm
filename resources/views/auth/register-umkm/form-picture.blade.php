<form id="myForm" enctype="multipart/form-data">
    @csrf
    <div class="form-group row" id="logo-group">
      <label class="col-md-4">Upload Logo UMKM</label>
      <div class="col-md-8">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFile" name="logo-umkm">
            <label class="custom-file-label" for="customFile">Choose file</label>
          </div>
          <small>Ukuran maks file 5 mb
            <br>
          </small>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <div id='file-info'></div>
        <img id="img-preview" src="" class="img-fluid" alt="Image" style="max-width:250px">
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-sm-8 my-1">
          <div id="progress">
              <div class="progress">
                  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
              </div>
              <span class="text-info" id="text-upload">0%</span>&nbsp;telah terupload
          </div>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-6">
        <a id="btnBack" class="btn btn-secondary float-left" href="{{ route('register.formUmkmDetail')}}">Kembali <i class="fas fa-arrow-left"></i></a>
      </div>
      <div class="col-6">
        <button id="btnSubmit" type="submit" class="btn btn-success float-right">Selesai <i class="fas fa-save"></i></button>
      </div>
    </div>
</form>
@include('partial.message')

@push('script')
    <script>
      $('#progress').hide();
      $('#img-preview').hide();
      $(document).ready(function(){
        $("#myForm").on('submit', function(e){
            e.preventDefault();
            if($('#customFile').val() == ''){
                $('#my_alert').removeClass('alert-success');
                $('#my_alert').addClass('alert-danger');
                $('#alert_text').html("Belum ada file yang dipilih");
                alertShow();
                return false;
            }
            $('#progress').show();
            $('#btnBack').hide();
            $('#btnSubmit').hide();
            var formData = new FormData(this);
            $.ajax({
                url : "{{route('register.saveUmkmPicture') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    
                },
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = (evt.loaded / evt.total) * 100;
                            $('.progress-bar').prop('aria-valuenow', percentComplete);
                            $('.progress-bar').css('width', percentComplete + '%');
                            $('#text-upload').html(percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },
                success: function (data)
                {
                  $('#progress').hide();
                  $('#btn-upload').show();
                  $('#btn-cancel').show();
                  setTimeout(window.location.href = "{{ route('register.umkmFinish') }}", 3000);
                },
                error: function(x, status, error){
                    $('#progress').hide();
                    $('#btnBack').show();
                    $('#btnSubmit').show();
                    $('#my_alert').removeClass('alert-success');
                    $('#my_alert').addClass('alert-danger');
                    $('#alert_text').html('Error, '+ x.responseJSON.msg);
                    alertShow();
                }
            });
           
            return false;

        });
        // file handler
      $(document).on("change", "#customFile", function() {
          if($(this).val() != ''){
              var input = this;
              var file_size = input.files[0].size;
              var file_type = input.files[0].type;

              var acc_type = [
                  "image/x-png",
                  "image/png",
                  "image/jpeg",
                  "image/jpg",
              ];
              
              if(file_size > 5242880){
                  alert("Ukuran file maksimal: 5MB");
                  $("#customFile").val("");      
                  return false;
              }

              if(acc_type.indexOf(file_type) == -1){
                  alert(
                      "Ekstensi File tidak valid !! Accepted Extension : .jpg, .png",
                  );
                  $("#customFile").val("");      
                  return false;
              }

              $('#file-info').html( '<button class="btn btn-danger btn-sm" id="cancel-file">X</button>'+
                                '<label class="form-control-label ml-2">'+input.files[0].name+
                              '&nbsp;'+formatBytes(file_size)+'</label>');
              $('#cancel-file').on('click', function(){
                  $("#customFile").val("");      
                  $('#customFile').html('');
                  $('#file-info').html('');
                  $('#img-preview').attr('src', '')   
                  $('#img-preview').hide(); 
                  $('#logo-group').show();             
              })  
              $('#logo-group').hide();                        
              readURL(input)  
          }
      });
      })
      function formatBytes(bytes, decimals = 2) {
          if (bytes === 0) return '0 Bytes';

          const k = 1024;
          const dm = decimals < 0 ? 0 : decimals;
          const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

          const i = Math.floor(Math.log(bytes) / Math.log(k));

          return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
      }

      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          
          reader.onload = function(e) {
            $('#img-preview').attr('src', e.target.result)   
            $('#img-preview').show(); 
          }
          
          reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
      }
    </script>
@endpush