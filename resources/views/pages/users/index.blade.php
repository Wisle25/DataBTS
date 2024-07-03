@extends('components.layout.index')

@section('content')
@component('components.section.title')
Data Pengguna
@endcomponent

@include('components.allert.success')

<div class="flex">
    {{-- Tombol tambah data --}}
    <!-- @component('components.button.btn-tambah', ['url' => url('bts/create')]) -->
    <!-- @endcomponent -->
</div>

<!-- <div class="flex mt-3">
        @component('components.section.search', ['url' => url('bts'), 'placeholder' => 'Search Nama BTS'])
        @endcomponent
        <div class="ms-auto flex">
            @component('components.section.exportExcel', ['route' => route('bts.exportExcel')])
            Export Excel
            @endcomponent
            @component('components.section.exportPdf', ['route' => route('bts.exportPdf')])
            Export Pdf
            @endcomponent
        </div>
    </div> -->

{{-- Tabel BTS --}}
@component('components.table.index', [
'columns' => ['No', 'Nama', 'Username', 'Email', 'Password'],
])


<tr class="hover:bg-gray-100 cursor-pointer">
    <td class="px-5 py-2 text-center">1</td>
    <td class="px-4 py-2 text-center">Ferdy</td>
    <td class="px-4 py-2 text-center">ferdy</td>
    <td class="px-4 py-2 text-center">ferdy@gmail.com</td>
    <td class="px-4 py-2 text-center">passpass123</td>


</tr>

@endcomponent


@component('components.allert.modal')
Data Pengguna
@endcomponent
@endsection