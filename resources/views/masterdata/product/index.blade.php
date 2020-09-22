@extends('layouts.admin')

@section('content-header', 'Kelola Produk')

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
@endpush