@extends('components.layout.index')

@section('content')
    @component('components.section.title')
        Data Monitoring
    @endcomponent

    @include('components.allert.success')

    <div class="flex">
        {{-- Tombol tambah data --}}
        @component('components.button.btn-tambah', ['url' => url('monitoring/create')])
        @endcomponent
    </div>

    <div class="flex mt-3">
        @component('components.section.search', ['url' => url('monitoring'), 'placeholder' => 'Search Nama monitoring'])
        @endcomponent
        @include('components.section.export')
    </div>

    {{-- Tabel Monitoring --}}
    @component('components.table.index', [
        'columns' => ['No', 'ID BTS', 'Kondisi'],
    ])
        @foreach ($monitorings as $index => $monitoring)
            <tr class="hover:bg-gray-100 cursor-pointer" onclick="showDetails({{ json_encode($monitoring) }})">
                <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                <td class="px-4 py-2 text-center">{{ $monitoring['id_bts'] }}</td>
                <td class="px-4 py-2 text-center">{{ $monitoring['kondisi_bts'] }}</td>
                <td class="px-4 py-2 text-center" onclick="event.stopPropagation();">
                    <div class="flex justify-center items-center space-x-2">
                        <x-button.btn-action editUrl="{{ url('monitoring/' . $monitoring['id'] . '/edit') }}"
                            deleteUrl="{{ url('monitoring/' . $monitoring['id']) }}"
                            deleteMessage="Are you sure you want to delete this item?" />
                    </div>
                </td>
            </tr>
        @endforeach
    @endcomponent

    @component('components.allert.modal')
        Data Monitoring
    @endcomponent


    <script>
        function showDetails(data) {
            const modal = document.getElementById('detailModal');
            const modalContent = document.getElementById('modalContent');

            modalContent.innerHTML = `
    <table class="border-collapse">
    <tr>
        <td class="px-6 py-1">ID BTS</td>
        <td class="px-14 py-1">${data.id_bts}</td>
    </tr>
    <tr>
        <td class="px-6 py-1">Kondisi</td>
        <td class="px-14 py-1">${data.kondisi_bts}</td>
    </tr>
    <tr>
        <td class="px-6 py-1">Tahun</td>
        <td class="px-14 py-1">${data.tahun}</td>
    </tr>
    <tr>
        <td class="px-6 py-1">Tgl Generate</td>
        <td class="px-14 py-1">${data.tgl_generate}</td>
    </tr>
    <tr>
        <td class="px-6 py-1">Tgl kunjungan</td>
        <td class="px-14 py-1">${data.tgl_kunjungan}</td>
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
