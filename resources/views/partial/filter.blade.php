<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Filter</div>
                <a class="float-right" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                   <i class="fa fa-angle-down"></i>
                </a>
            </div>
            <div class="collapse show" id="collapseExample">
                <div class="card-body p-2">
                    <form class="form-vertical" method="get" action="" id="myForm" name="myForm" autocomplete="off">
                        <div class="row m-0">
                            <div class="col-12">
                                {{-- Filter --}}
                                <div class="form-group row m-2 p-0">
                                    <div class="col-md-2">
                                        <select name="filters" id="filters" class="form-control" width="100%">
                                            <option value="4">Bulan Ini</option>
                                            <option value="2">Hari Ini</option>
                                            <option value="3">Pekan Ini</option>
                                            <option value="5">Tahun Ini</option>
                                            <option value="6">Rentang Tanggal</option>
                                            <option value="1">Semua</option>
                                        </select>
                                        @error('filters')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                    
                                    {{-- Date Range --}}
                                    <div class="col-md-4 d-none" id="date-range">
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker" id="date_1" name="date_1" placeholder="Dari" autocomplete="off" value="{{ isset($date['date_1']) ? $date['date_1'] : null }}">
                                            <div class="input-group-prepend input-group-append">
                                                <span class="input-group-text font-w600">s/d</span>
                                            </div>
                                            <input type="text" class="form-control datepicker" id="date_2" name="date_2" placeholder="Hingga" autocomplete="off" value="{{ isset($date['date_2']) ? $date['date_2'] : null }}">
                                        </div>
                                    </div>
                    
                                    {{-- Form Button --}}
                                    <div class="col">
                                        <div class="text-left">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fa fa-search"></i> Filter
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@section('js')
<script>
    $(document).ready(function(){ 
        
        $('.datepicker').daterangepicker({
            locale: {
                cancelLabel: 'Clear',
                format: "DD/MM/YYYY",
            },
            singleDatePicker: true,
            showDropdowns: true,
        });
        $(document).on("focusout", ".datepicker", function() {
            $(this).prop('readonly', false);
        });

        $(document).on("focusin", ".datepicker", function() {
            $(this).prop('readonly', true);
        });

        $('#filters').select2({
            'placeholder' : "Pilih"
        })

        $('#filters').val( {{ $filters }}).trigger('change');
        
        if($('#filters').val() == 6){
                $( "#date-range" ).removeClass('d-none');
                $( "#date-range" ).slideDown();
            }else{
                $('#date-range').hide('slow');
        }
        $('#filters').on('change', function() {
            if($(this).val() == 6){
                $( "#date-range" ).removeClass('d-none');
                $( "#date-range" ).slideDown();
            }else{
                $('#date-range').hide('slow');
            }
        })
    });
</script>
    
@endsection