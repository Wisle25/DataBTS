@extends('components.layout.index')

@section('content')
@component('components.section.title')
Data BTS
@endcomponent

@include('components.allert.success')

@auth
@if (auth()->user()->peran=="Administrator" || auth()->user()->peran=="PIC")
<div class="flex">
    {{-- Tombol tambah data --}}
    @component('components.button.btn-tambah', ['url' => url('bts/create')])
    @endcomponent
</div>
@endif
@endauth

<div class="flex mt-3">
    @component('components.section.search', ['url' => url('bts'), 'placeholder' => 'Search Nama BTS'])
    @endcomponent
    @auth
    @if (auth()->user()->peran=="Administrator" || auth()->user()->peran=="PIC")
    <div class="ms-auto flex">
        @component('components.section.exportExcel', ['route' => route('bts.exportExcel')])
        Export Excel
        @endcomponent
        @component('components.section.exportPdf', ['route' => route('bts.exportPdf')])
        Export Pdf
        @endcomponent
    </div>
    @endif
    @endauth
</div>

{{-- Tabel BTS --}}
@component('components.table.index', [
    'columns' => ['No', 'Nama', 'Alamat', 'Wilayah', 'Latitude', 'Longitude', 'Tinggi Tower', 'Pemilik', 'Jenis'],
    'actionLabel' => auth()->check() ? 'Actions' : null
])
    @foreach ($data as $index => $bts)
    <tr class="hover:bg-gray-100 cursor-pointer" onclick="showDetails({{ json_encode($bts) }})">
        <td class="px-5 py-2 text-center">{{ ($data->currentPage() - 1) * $data->perPage() + $index + 1 }}</td>
        <td class="px-4 py-2 text-center">{{ $bts['nama'] }}</td>
        <td class="px-4 py-2 text-center">{{ $bts['alamat'] }}</td>
        <td class="px-4 py-2 text-center">{{ $bts->wilayah->nama }}</td>
        <td class="px-4 py-2 text-center">{{ $bts['latitude'] }}</td>
        <td class="px-4 py-2 text-center">{{ $bts['longitude'] }}</td>
        <td class="px-4 py-2 text-center">{{ $bts['tinggi_tower'] }}</td>
        <td class="px-4 py-2 text-center hover:underline hover:text-blue-700" onclick="event.stopPropagation();">
            <a href="{{ route('pemilik.show', $bts->pemilik->id) }}">{{ $bts->pemilik->name }}</a>
        </td>
        <td class="px-4 py-2 text-center hover:underline hover:text-blue-700" onclick="event.stopPropagation();">
            <a href="{{ route('jenis_bts.show', $bts->jenisBTS->id) }}">{{ $bts->jenisBTS->nama }}</a>
        </td>

        @auth
        @if (auth()->user()->peran == "Administrator" || auth()->user()->peran == "PIC")
        <td class="px-4 py-2 text-center" onclick="event.stopPropagation();">
            <div class="flex justify-center items-center space-x-2">
                <x-button.btn-action editUrl="{{ url('bts/' . $bts['id'] . '/edit') }}" deleteUrl="{{ url('bts/' . $bts['id']) }}" deleteMessage="Are you sure you want to delete this item?" />
            </div>
        </td>
        @endif
        @endauth

        @auth
        @if (auth()->user()->peran == "User" || auth()->user()->peran == "")
        <td class="px-4 py-2 text-center" onclick="event.stopPropagation();">
            <div class="flex justify-center items-center space-x-2">
                <a>None</a>
            </div>
        </td>
        @endif
        @endauth
    </tr>
    @endforeach
@endcomponent

<!-- Pagination links -->
<div class="mt-4 mx-2">
    {{ $data->links() }}
</div>

@component('components.allert.modal')
Data BTS
@endcomponent


{{-- Maps --}}
<div id="peta-container" class="my-10 mx-3 z-0">
    @component('components.section.title')
    Peta Persebaran BTS
    @endcomponent
    <div id="peta" style="height: 500px"></div>
</div>

<script>
    // To show detail
    function showDetails(data) {
        const modal = document.getElementById('detailModal');
        const modalContent = document.getElementById('modalContent');

        modalContent.innerHTML = `
            <table class="border-collapse">
                <tr class="text-center">
                    <td class="px-14 py-1" colspan="2">
                        <img src="{{ url('path_foto') }}/${data.path_foto}" style="max-width: 300px; height: auto; display: block; margin: 0 auto;">
                    </td>
                </tr>
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
            </table>
                    `;

        modal.classList.remove('hidden');
    }

    function closeModal() {
        const modal = document.getElementById('detailModal');
        modal.classList.add('hidden');
    }


    // Pass BTS data to JavaScript
    const btsData = @json($allBTSData);

    // Provide Map in Webpage
    const providerOSM = new GeoSearch.OpenStreetMapProvider();

    // leaflet map
    var leafletMap = L.map('peta', {
        fullscreenControl: {
            pseudoFullscreen: false
        },
        minZoom: 4
    }).setView([-1, 121], 5);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(leafletMap);

    // Function to add BTS markers
    function addBTSMarkers(btsData) {
        btsData.forEach(bts => {
            let marker = L.marker([bts.latitude, bts.longitude]).addTo(leafletMap);
            marker.bindPopup(`<b>${bts.nama}</b><br>Alamat: ${bts.alamat}<br>Tinggi Tower: ${bts.tinggi_tower}`);
        });
    }

    // Call the function to add BTS markers
    addBTSMarkers(btsData);
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