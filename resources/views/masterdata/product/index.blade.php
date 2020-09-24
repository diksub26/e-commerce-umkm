@extends('layouts.admin')

@section('content-header', 'Kelola Produk')
@section('title', 'Kelola Data Produk')

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

@push('styles')
    <link href="{{ asset('css/vendor/dt/dt.css') }}" rel="stylesheet">
@endpush

@push('script')
    <script src="{{ asset('js/plugins/dt/dt.js')}}"></script>
    {!! $dataTable->scripts() !!}
    <script src="{{ config('my_config.assets.js.swal')}}"></script>
    <script>
        function deleteData(product){
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
                        url: "{{ route('masterdata.product.destroy') }}",
                        data: {product: product},
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