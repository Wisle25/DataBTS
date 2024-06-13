@extends('components.layout.index')

@section('content')
    @component('components.section.title')
        Data BTS
    @endcomponent

    @include('components.allert.success')

    <div class="flex">
        {{-- Tombol tambah data --}}
        @component('components.button.btn-tambah', ['url' => url('bts/create')])
        @endcomponent
    </div>

    <div class="flex mt-3">
        @component('components.section.search', ['url' => url('bts'), 'placeholder' => 'Search Nama BTS'])
        @endcomponent
        @include('components.section.export')
    </div>

    {{-- Tabel BTS --}}
    @component('components.table.index', [
        'columns' => ['No', 'Nama', 'Alamat', 'Latitude', 'Lontitude', 'Tinggi Tower', 'Panjang Tanah', 'Lebar Tanah'],
    ])
        @foreach ($data as $index => $bts)
            <tr class="hover:bg-gray-100 cursor-pointer" onclick="showDetails({{ json_encode($bts) }})">
                <td class="px-5 py-2 text-center">{{ $index + 1 }}</td>
                <td class="px-4 py-2 text-center">{{ $bts['nama'] }}</td>
                <td class="px-4 py-2 text-center">{{ $bts['alamat'] }}</td>
                <td class="px-4 py-2 text-center">{{ $bts['latitude'] }}</td>
                <td class="px-4 py-2 text-center">{{ $bts['longitude'] }}</td>
                <td class="px-4 py-2 text-center">{{ $bts['tinggi_tower'] }}</td>
                <td class="px-4 py-2 text-center">{{ $bts['panjang_tanah'] }}</td>
                <td class="px-4 py-2 text-center">{{ $bts['lebar_tanah'] }}</td>
                <td class="px-4 py-2 text-center" onclick="event.stopPropagation();">
                    <div class="flex justify-center items-center space-x-2">
                        <x-button.btn-action editUrl="{{ url('bts/' . $bts['id'] . '/edit') }}"
                            deleteUrl="{{ url('bts/' . $bts['id']) }}"
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
        Data BTS
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
                    <td class="px-6 py-1">Alamat</td>
                    <td class="px-14 py-1">${data.alamat}</td>
                </tr>
                <tr>
                    <td class="px-6 py-1">Latitude</td>
                    <td class="px-14 py-1">${data.latitude}</td>
                </tr>
                <tr>
                    <td class="px-6 py-1">Longitude</td>
                    <td class="px-14 py-1">${data.longitude}</td>
                </tr>
                <tr>
                    <td class="px-6 py-1">Tinggi Tower</td>
                    <td class="px-14 py-1">${data.tinggi_tower}</td>
                </tr>
                <tr>
                    <td class="px-6 py-1">Panjang Tanah</td>
                    <td class="px-14 py-1">${data.panjang_tanah}</td>
                </tr>
                <tr>
                    <td class="px-6 py-1">Lebar Tanah</td>
                    <td class="px-14 py-1">${data.lebar_tanah}</td>
                </tr>
                <tr>
                    <td class="px-6 py-1">Genset</td>
                    <td class="px-14 py-1">${data.ada_genset}</td>
                </tr>
                <tr>
                    <td class="px-6 py-1">Tembok Batas</td>
                    <td class="px-14 py-1">${data.ada_tembok_batas}</td>
                </tr>
                <tr>
                    <td class="px-6 py-1">Created At</td>
                    <td class="px-14 py-1">${data.created_at}</td>
                    </tr>
                <tr>
                    <td class="px-6 py-1">Edited At</td>
                    <td class="px-14 py-1">${data.edited_at}</td>
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
