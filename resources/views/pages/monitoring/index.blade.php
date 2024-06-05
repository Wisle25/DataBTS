@extends('components.layout.index')

@section('content')
    @component('components.section.index', ['placeholder' => 'Search Nama Monitoring'])
        Data Monitoring
    @endcomponent

    {{-- Tombol tambah data --}}
    @component('components.button.btn-tambah', ['url' => url('bts/create')])
    @endcomponent

    {{-- Tabel Monitoring --}}
    @component('components.table.index', [
        'columns' => ['No', 'Tahun', 'Tgl Kunjungan'],
    ])
    @endcomponent
@endsection
