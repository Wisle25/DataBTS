@extends('components.layout.index')

@section('content')
    @component('components.section.title')
        Data Wilayah
    @endcomponent

    @include('components.allert.success')

    <div class="flex">
        {{-- Tombol tambah data --}}
        @component('components.button.btn-tambah', ['url' => url('wilayah/create')])
        @endcomponent
    </div>

    <div class="flex mt-3">
        @component('components.section.search', ['url' => url('wilayah'), 'placeholder' => 'Search Nama wilayah'])
        @endcomponent
        <div class="ms-auto flex">
            @component('components.section.exportExcel', ['route' => route('wilayah.exportExcel')])
                Export Excel
            @endcomponent
            @component('components.section.exportPdf', ['route' => route('wilayah.exportPdf')])
                Export Pdf
            @endcomponent
        </div>
    </div>

    {{-- Tabel wilayah --}}
    @component('components.table.index', [
        'columns' => ['No', 'Nama', 'Level', 'ID Parent'],
    ])
        @foreach ($data as $index => $wilayah)
            <tr class="hover:bg-gray-100 cursor-pointer" onclick="showDetails({{ json_encode($wilayah) }})">
                <td class="px-5 py-2 text-center">{{ ($data->currentPage() - 1) * $data->perPage() + $index + 1 }}</td>
                <td class="px-4 py-2 text-center">{{ $wilayah['nama'] }}</td>
                <td class="px-4 py-2 text-center">{{ $wilayah['level'] }}</td>
                <td class="px-4 py-2 text-center">{{ $wilayah['id_parent'] }}</td>
                <td class="px-4 py-2 text-center" onclick="event.stopPropagation();">
                    <div class="flex justify-center items-center space-x-2">

                        <x-button.btn-action editUrl="{{ url('wilayah/' . $wilayah['id'] . '/edit') }}"
                            deleteUrl="{{ url('wilayah/' . $wilayah['id']) }}"
                            deleteMessage="Are you sure you want to delete this item?" />
                    </div>
                </td>
            </tr>
        @endforeach
    @endcomponent


    <!-- Pagination links -->
    <div class="mt-4 mx-2">
        {{ $data->links() }}
    </div>

    {{-- @include('components.section.pagination') --}}


    @component('components.allert.modal')
        Data wilayah
    @endcomponent

    <script>
        function showDetails(data) {
            const modal = document.getElementById('detailModal');
            const modalContent = document.getElementById('modalContent');

            modalContent.innerHTML = `
            <table class="border-collapse">
                <tr>
                    <td class="px-6 py-1">Nama</td>
                    <td class="px-14 py-1">${data.nama}</td>
                </tr>
                <tr>
                    <td class="px-6 py-1">ID parent</td>
                    <td class="px-14 py-1">${data.id_parent}</td>
                </tr>
                <tr>
                    <td class="px-6 py-1">Level</td>
                    <td class="px-14 py-1">${data.level}</td>
                </tr>
                    </table>
                    `;

            modal.classList.remove('hidden');
        }

        function closeModal() {
            const modal = document.getElementById('detailModal');
            modal.classList.add('hidden');
        }
    </script>
@endsection

{{-- <tr>
    <td class="px-6 py-1">Edited By</td>
    <td class="px-14 py-1">${data.edited_by}</td>
    </tr>
    <tr>
    <td class="px-6 py-1">ID User Pic</td>
    <td class="px-14 py-1">${data.id_user_pic}</td>
</tr>
<tr>
    <td class="px-6 py-1">ID Pemilik</td>
    <td class="px-14 py-1">${data.id_pemilik}</td>
</tr>
<tr>
    <td class="px-6 py-1">ID Wilayah</td>
    <td class="px-14 py-1">${data.id_wilayah}</td>
</tr>
<tr>
    <td class="px-6 py-1">Created By</td>
    <td class="px-14 py-1">${data.created_by}</td>
</tr> --}}
