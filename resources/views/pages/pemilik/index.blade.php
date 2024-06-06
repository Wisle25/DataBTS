@extends('components.layout.index')

@section('content')
    @component('components.section.index', ['placeholder' => 'Search Pemilik'])
        Pemilik
    @endcomponent

    {{-- Tombol tambah data --}}
    @component('components.button.btn-tambah', ['url' => url('pemilik/create')])
    @endcomponent

    {{-- Tabel BTS --}}
    @component('components.table.index', [
        'columns' => ['No', 'Nama', 'Alamat', 'Telepon'],
    ])
        @php
        $btsData = [
            [
                'nama' => 'Pemilik 1',
                'alamat' => 'Alamat 1',
                'telepon' => '00000000000',
                'created_by' => 'Admin',
                'edited_by' => 'Admin',
                'created_at' => '2023-01-01',
                'edited_at' => 'Klaten'
            ],
            [
                'nama' => 'Pemilik 2',
                'alamat' => 'Alamat 2',
                'telepon' => '00000000000',
                'created_by' => 'Admin',
                'edited_by' => 'Admin',
                'created_at' => '2023-01-01',
                'edited_at' => 'Klaten'
            ],
            [
                'nama' => 'Pemilik 3',
                'alamat' => 'Alamat 3',
                'telepon' => '00000000000',
                'created_by' => 'Admin',
                'edited_by' => 'Admin',
                'created_at' => '2023-01-01',
                'edited_at' => 'Klaten'
            ]
            // Tambahkan data lainnya di sini
            ];
        @endphp
        @foreach ($btsData as $index => $bts)
        <tr class="hover:bg-gray-100 cursor-pointer" onclick="showDetails({{ json_encode($bts) }})">
            <td class="px-5 py-2 text-center">{{ $index + 1 }}</td>
            <td class="px-4 py-2 text-center">{{ $bts['nama'] }}</td>
            <td class="px-4 py-2 text-center">{{ $bts['alamat'] }}</td>
            <td class="px-4 py-2 text-center">{{ $bts['telepon'] }}</td>
            <td class="px-4 py-2 text-center">

                {{-- <a href='{{ url('bts/'.$item->id.'/edit') }}' class="btn btn-warning btn-sm">Edit</a> --}}
                {{-- <form onsubmit="return confirm('Yakin akan menghapus data?')" class='d-inline' action="{{ url('bts/'.$item->id) }}" method="post"> --}}

                <x-button.btn-action 
                    edit-url="/pemilik/edit"
                    {{-- delete-url="{{ url('bts', $bts['id']) }}" delete-message="Yakin akan menghapus data?" /> --}}
                    delete-url="" delete-message="Yakin akan menghapus data?" />
                </div>
            </td>
        </tr>
        @endforeach

        @component('components.allert.modal')
        Data Pemilik
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
                    <td class="px-6 py-1">Telepon</td>
                    <td class="px-14 py-1">${data.telepon}</td>
                </tr>

                <tr>
                    <td class="px-6 py-1 text-xs text-blue-500">Created By</td>
                    <td class="px-14 py-1 text-xs text-blue-500">${data.created_by}</td>
                </tr>
                <tr>
                    <td class="px-6 py-1 text-xs text-blue-500">Edited By</td>
                    <td class="px-14 py-1 text-xs text-blue-500">${data.edited_by}</td>
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

    @endcomponent
@endsection