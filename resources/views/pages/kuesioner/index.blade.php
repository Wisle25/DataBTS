@extends('components.layout.index')

@section('content')
    @component('components.section.index', ['placeholder' => 'Search Kuesioner'])
        Kuesioner
    @endcomponent

    {{-- Tombol tambah data --}}
    @component('components.button.btn-tambah', ['url' => url('kuesioner/create')])
    @endcomponent

    {{-- Tabel --}}
    @component('components.table.index', [
        'columns' => ['No', 'Pertanyaan', 'Created By', 'Edited By', 'Created At', 'Edited At'],
    ])
    @endcomponent
@endsection
