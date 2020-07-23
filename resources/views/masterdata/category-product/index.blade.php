@extends('layouts.admin')

@section('content-header', 'Kelola Kategori Produk')

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

@section('script')
    {!! $dataTable->scripts() !!}
@endsection