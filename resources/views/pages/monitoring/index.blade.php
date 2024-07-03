@extends('components.layout.index')

@section('content')
    @component('components.section.title')
        Data Monitoring
    @endcomponent

    @include('components.allert.success')

    @auth
    @if (auth()->user()->peran == "Administrator" || auth()->user()->peran == "Surveyor")
    <div class="flex">
        {{-- Tombol tambah data --}}
        @component('components.button.btn-tambah', ['url' => url('monitoring/create')])
        @endcomponent
    </div>
    @endif
    @endauth

    <div class="flex mt-3">
        @component('components.section.search', ['url' => url('monitoring'), 'placeholder' => 'Search Nama BTS'])
        @endcomponent

        @auth
        @if (auth()->user()->peran == "Administrator" || auth()->user()->peran == "Surveyor")
        <!-- Add a new button to open the new modal -->
        <button onclick="toggleModal('btsModalCurrentMonth')" class="bg-blue-500 hover:bg-blue-700 text-white font-medium px-4 rounded">
            See detail for current month
        </button>
        <div class="ms-auto flex">
        @component('components.section.exportExcel', ['route' => route('monitoring.exportExcel')])
            Export Excel
        @endcomponent
        @component('components.section.exportPdf', ['route' => route('monitoring.exportPdf')])
            Export Pdf
        @endcomponent
        </div>
        @endif
        @endauth
    </div>
    

    {{-- Tabel Monitoring --}}
    @component('components.table.index', [
        'columns' => ['No', 'Nama BTS', 'Tgl Kunjungan', 'Tgl Generate', 'Kondisi'],
        'actionLabel' => auth()->check() ? 'Actions' : null
    ])
        @foreach ($monitorings as $index => $monitoring)
            <tr class="hover:bg-gray-100 cursor-pointer" onclick="showDetails({{ json_encode($monitoring) }})">
                <td class="px-4 py-2 text-center">{{ ($monitorings->currentPage() - 1) * $monitorings->perPage() + $index + 1 }}</td>
                <td class="px-4 py-2 text-center">{{ $monitoring->bts->nama }}</td>
                <td class="px-4 py-2 text-center">{{ $monitoring->tgl_kunjungan }}</td>
                <td class="px-4 py-2 text-center">{{ $monitoring->tgl_generate }}</td>
                <td class="px-4 py-2 text-center">
                    <div class="inline-block rounded border px-3 py-1
                        @php
                            $statusColors = [
                                'Normal' => 'bg-teal-300 font-medium',
                                'Fault' => 'bg-red-500 text-white font-medium',
                                'Maintenance' => 'bg-yellow-300 font-medium',
                                'Offline' => 'bg-gray-300 font-medium',
                            ];
                            $status = $monitoring->kondisi_bts->nama;
                            $backgroundColor = $statusColors[$status] ?? 'bg-gray-100'; // Default to gray if status is not found
                        @endphp
                        {{ $backgroundColor }}
                    ">
                        {{ $status }}
                    </div>
                </td>
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

    <!-- Pagination links -->
    <div class="mt-4 mx-2">
        {{ $monitorings->links() }}
    </div>

    <!-- Existing modal -->
    <div id="btsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">BTS yang belum dilakukan monitoring</h3>
                <div class="mt-2 px-7 py-3">
                    <table class="min-w-full bg-white border">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border">ID BTS</th>
                                <th class="py-2 px-4 border">Nama BTS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notMonitoredBts as $bts)
                                <tr>
                                    <td class="py-2 px-4 border">{{ $bts->id }}</td>
                                    <td class="py-2 px-4 border">{{ $bts->nama }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="items-center px-4 py-3">
                    <button onclick="toggleModal('btsModal')" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- New modal for BTS not monitored this month -->
    <div id="btsModalCurrentMonth" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">BTS yang belum dilakukan monitoring bulan ini</h3>
                <div class="mt-2 px-7 py-3">
                    <table class="min-w-full bg-white border">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border">ID BTS</th>
                                <th class="py-2 px-4 border">Nama BTS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notMonitoredBtsCurrentMonth as $bts)
                                <tr>
                                    <td class="py-2 px-4 border">{{ $bts->id }}</td>
                                    <td class="py-2 px-4 border">{{ $bts->nama }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="items-center px-4 py-3">
                    <button onclick="toggleModal('btsModalCurrentMonth')" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>



    @component('components.allert.modal')
        Data Monitoring
    @endcomponent

    @include('pages.monitoring.scatter-plot')
    @include('pages.monitoring.pie-chart')
    <script>
        function toggleModal(modalID) {
            document.getElementById(modalID).classList.toggle('hidden');
        }

        function showDetails(data) {
            const modal = document.getElementById('detailModal');
            const modalContent = document.getElementById('modalContent');

            modalContent.innerHTML = `
                <table class="border-collapse">
                    <tr>
                        <td class="px-6 py-1">ID BTS</td>
                        <td class="px-14 py-1">${data.bts.nama}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-1">Kondisi</td>
                        <td class="px-14 py-1">${data.kondisi_bts.nama}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-1">Tahun</td>
                        <td class="px-14 py-1">${data.tahun}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-1">Tgl kunjungan</td>
                        <td class="px-14 py-1">${data.tgl_kunjungan}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-1">Tgl Generate</td>
                        <td class="px-14 py-1">${data.tgl_generate}</td>
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