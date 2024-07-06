@extends('components.layout.index')

@section('content')
    @component('components.section.title')
        Data Pengguna
    @endcomponent

    @include('components.allert.success')

    <div class="flex">
        {{-- Tombol tambah data --}}
        @component('components.button.btn-tambah', ['url' => url('pengguna/create')])
        @endcomponent
    </div>

    <div class="flex mt-3">
        @component('components.section.search', ['url' => url('pengguna'), 'placeholder' => 'Search Nama pengguna'])
        @endcomponent
        <div class="ms-auto flex">
            @component('components.section.exportExcel', ['route' => route('pengguna.exportExcel')])
                Export Excel
            @endcomponent
            @component('components.section.exportPdf', ['route' => route('pengguna.exportPdf')])
                Export Pdf
            @endcomponent
        </div>
    </div>
    @component('components.table.index', [
        'columns' => ['No', 'Nama', 'Username', 'Peran', 'Histori Login'],
        'actionLabel' => auth()->check() ? 'Actions' : null,
    ])
        @foreach ($pengguna as $index => $p)
            <tr class="hover:bg-gray-100 cursor-pointer" onclick="showDetails({{ json_encode($p) }})">
                <td class="px-5 py-1 text-center">{{ ($pengguna->currentPage() - 1) * $pengguna->perPage() + $index + 1 }}</td>
                <td class="px-4 py-1 text-center">{{ $p->nama }}</td>
                <td class="px-4 py-1 text-center">{{ $p->username }}</td>
                <td class="px-4 py-1 text-center">{{ $p->peran }}</td>
                <td class="px-4 py-1 text-center" onclick="event.stopPropagation();">
                    @if (isset($logs[$p->id]) && $logs[$p->id]->first())
                        <a href="{{ route('pengguna.log', $p->id) }}" class=" hover:underline hover:text-blue-700">
                            {{ $logs[$p->id]->first()->login_at }}
                        </a>
                    @else
                        No login record
                    @endif
                </td>
                <td class="px-4 py-1 text-center" onclick="event.stopPropagation();">
                    <x-button.btn-action editUrl="{{ url('pengguna/' . $p->id . '/edit') }}"
                        deleteUrl="{{ url('pengguna/' . $p->id) }}"
                        deleteMessage="Are you sure you want to delete this item?" />
                </td>
            </tr>
        @endforeach
    @endcomponent

    <!-- Pagination links -->
    <div class="mt-4 mx-2">
        {{ $pengguna->links() }}
    </div>

    @component('components.allert.modal')
        Data Pengguna
    @endcomponent


    <script>
        function showDetails(p) {
            const modal = document.getElementById('detailModal');
            const modalContent = document.getElementById('modalContent');

            modalContent.innerHTML = `
        <table class="border-collapse">
            <tr>
                <td class="px-16 py-1">Nama</td>
                <td class="px-16 py-3">${p.nama}</td>
            </tr>
            <tr>
                <td class="px-16 py-4">Username</td>
                <td class="px-16 py-4">${p.username}</td>
            </tr>
            <tr>
                <td class="px-16 py-3">Email</td>
                <td class="px-16 py-3">${p.email}</td>
            </tr>
            <tr>
                <td class="px-16 py-3">Peran</td>
                <td class="px-16 py-3">${p.peran}</td>
            </tr>
            <tr>
                <td class="px-16 py-3">Status</td>
                <td class="px-16 py-3">${p.status}</td>
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
