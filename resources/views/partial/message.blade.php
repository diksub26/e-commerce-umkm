<style>
  #my_alert{
    position: fixed;
    top: 50px; 
    right:2%;
    min-width: 20%;
    z-index:9999;
    display: none;
  }
</style>
@php
    if(\Session::has('msg')){
      $msg = \Session::get('msg');
    }
@endphp
<div class="alert alert-{{ isset($msg['type']) ? $msg['type'] : 'danger' }} alert-dismissible fade show" role="alert" id="my_alert">
    <span id="alert_text">
      {!! isset($msg['msg']) ? $msg['msg'] : 'An Error Occured' !!}
    </span>
    <button type="button" class="close" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>

@push('script')
<script>

  jQuery(document).ready(function(){
    @if (\Session::has('msg'))
      alertShow();
    @endif

    $('#my_alert > button').on('click', function(){
      $("#my_alert").hide(); 
    })
  })

  function alertShow(){
    $("#my_alert").show();
    setTimeout(function(){
      $("#my_alert").hide(); 
    }, 10000);
  }
</script>
    
@endpush