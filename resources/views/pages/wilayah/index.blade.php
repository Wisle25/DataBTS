@extends('components.layout.index')

@section('content')
    @component('components.section.index', ['placeholder' => 'Search Nama Wilayah'])
        Data Wilayah
    @endcomponent

    {{-- Tombol tambah data --}}
    @component('components.button.btn-tambah', ['url' => url('bts/create')])
    @endcomponent


    {{-- Tabel Wilayah --}}
    @component('components.table.index', [
        'columns' => ['No', 'Nama', 'Level'],
    ])
        @php
            $wilayahData = [
                [
                    'nama' => 'Wilayah 1',
                    'id_parent' => 1,
                    'level' => 1,
                    'created_by' => 'User 1',
                    'edited_by' => 'User 2',
                    'created_at' => '2024-02-01',
                    'edited_at' => '2024-05-01',
                ],
                [
                    'nama' => 'Wilayah 2',
                    'id_parent' => 2,
                    'level' => 2,
                    'created_by' => 'User 3',
                    'edited_by' => 'User 4',
                    'created_at' => '2023-04-21',
                    'edited_at' => '2024-03-22',
                ],
                // Tambahkan data lainnya di sini
            ];
        @endphp
        @foreach ($wilayahData as $index => $wilayah)
            <tr class="hover:bg-gray-100 cursor-pointer" onclick="showDetails({{ json_encode($wilayah) }})">
                <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                <td class="px-4 py-2 text-center">{{ $wilayah['nama'] }}</td>
                <td class="px-4 py-2 text-center">{{ $wilayah['level'] }}</td>
                <td class="px-4 py-2 text-center">
                    <div class="flex justify-center">

                        <a href='{{ url('bts/edit') }}' class="text-teal-700 hover:text-white hover:bg-teal-600 p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </a>
                        <form onsubmit="return confirm('Yakin akan menghapus data?')" class='d-inline ml-1 mr-2'
                            action="{{ url('mahasiswa/') }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="submit" class="text-rose-700 hover:text-white hover:bg-rose-600 p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    @endcomponent


    @component('components.allert.modal')
        Data Wilayah
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
                <td class="px-6 py-1">Level</td>
                <td class="px-14 py-1">${data.level}</td>
            </tr>
            <tr>
                <td class="px-6 py-1">Created By</td>
                <td class="px-14 py-1">${data.created_by}</td>
            </tr>
            <tr>
                <td class="px-6 py-1">Edited By</td>
                <td class="px-14 py-1">${data.edited_by}</td>
            </tr>
            <tr>
                <td class="px-6 py-1 text-xs text-blue-500">Created At</td>
                <td class="px-14 py-1 text-xs text-blue-500">${data.created_at}</td>
            </tr>
            <tr>
                <td class="px-6 py-1 text-xs text-blue-500">Edited At</td>
                <td class="px-14 py-1 text-xs text-blue-500">${data.edited_at}</td>
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
