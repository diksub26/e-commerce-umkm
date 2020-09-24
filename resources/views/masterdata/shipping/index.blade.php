@extends('layouts.admin')

@section('content-header', 'Kelola Master Pengiriman')
@section('title', 'Master Pengiriman')

@section('content')
    <div class="row">
        <div class="card col-12">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 table-responsive">
                        {{$dataTable->table(['class' => 'table table-stripped table-hover'], true)}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    {!! $dataTable->scripts() !!}
    <script src="{{ config('my_config.assets.js.swal')}}"></script>
    <script>
        function deleteData(shipping){
             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
            });
            swal({
                title: 'Apakah anda yakin ?',
                text: "Data yang dihapus tiak dapat dikembalikan !",
                icon: "warning",
                buttons: ["Batal", "Ya, hapus!"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: 'Delete',
                        url: "{{ route('masterdata.shipping.destroy') }}",
                        data: {shipping: shipping},
                        error: function(x, status, error){
                            swal(
                                'Error!',
                                x.responseJSON.message,
                                'error'
                            )
                        },
                        success: function(result){
                            swal(
                                'Success',
                                'Data Berhasil Dihapus',
                                'success'
                            )

                            let tabel = $('#my-table').DataTable();
                            tabel.ajax.reload();
                        }
                    });
                }
            });
        }
    </script>
@endpush