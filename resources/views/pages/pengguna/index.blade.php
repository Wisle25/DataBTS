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
        'columns' => ['No', 'Nama', 'Username', 'Peran'],
        'actionLabel' => auth()->check() ? 'Actions' : null
    ])
        @foreach ($pengguna as $index => $p)
            <tr class="hover:bg-gray-100 cursor-pointer" onclick="showDetails({{ json_encode($p) }})">
                <td class="px-5 py-1 text-center">{{ ($pengguna->currentPage() - 1) * $pengguna->perPage() + $index + 1 }}</td>
                <td class="px-4 py-1 text-center">{{ $p->nama }}</td>
                <td class="px-4 py-1 text-center">{{ $p->username }}</td>
                <td class="px-4 py-1 text-center">{{ $p->peran }}</td>
                <td class="px-4 py-1 text-center" onclick="event.stopPropagation();">
                    <div class="flex justify-center items-center space-x-2">
                        <div class="flex justify-center">
                            <form onsubmit="return confirm('Are you sure you want to delete this item?')" class="d-inline ml-1 mr-2" action="{{ url('pengguna/' . $p->id) }}"
                                method="post">
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
                    </div>
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
                <td class="px-4 py-1">Nama</td>
                <td class="px-4 py-3">${p.nama}</td>
            </tr>
            <tr>
                <td class="px-4 py-4">Username</td>
                <td class="px-4 py-4">${p.username}</td>
            </tr>
            <tr>
                <td class="px-4 py-3">Email</td>
                <td class="px-4 py-3">${p.email}</td>
            </tr>
            <tr>
                <td class="px-4 py-3">Peran</td>
                <td class="px-4 py-3">${p.peran}</td>
            </tr>
            <tr>
                <td class="px-4 py-3">Status</td>
                <td class="px-4 py-3">${p.status}</td>
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
