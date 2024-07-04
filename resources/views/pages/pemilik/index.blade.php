<div class="items-center px-2 pt-3 bg-violet-200 rounded-md shadow-sm">
    <div class="flex">
        <p class="ml-4 mr-1 text-xl font-semibold">Pemilik BTS</p>
        <x-button.btn-action-tambah :url="url('pemilik/create')" />
        <div class="ms-auto flex">
            @component('components.section.exportExcel', ['route' => route('pemilik.exportExcel')])
                Export Excel
            @endcomponent
            @component('components.section.exportPdf', ['route' => route('pemilik.exportPdf')])
                Export Pdf
            @endcomponent
        </div>
    </div>
    @component('components.table.index', [
        'columns' => ['No', 'Nama', 'Alamat', 'Telepon'],
        'actionLabel' => auth()->check() ? 'Actions' : null
    ])
        @foreach ($pemilik as $index => $p)
            <tr class="hover:bg-gray-100 cursor-pointer" onclick="showDetails({{ json_encode($p) }})">
                <td class="px-5 py-1 text-center">{{ ($pemilik->currentPage() - 1) * $pemilik->perPage() + $index + 1 }}</td>
                <td class="px-4 py-1 text-center">{{ $p->name }}</td>
                <td class="px-4 py-1 text-center">{{ $p->alamat }}</td>
                <td class="px-4 py-1 text-center">{{ $p->telepon }}</td>
                <td class="px-4 py-1 text-center" onclick="event.stopPropagation();">
                    <div class="flex justify-center items-center space-x-2">
                        <x-button.btn-action editUrl="{{ url('pemilik/' . $p->id . '/edit') }}"
                            deleteUrl="{{ url('pemilik/' . $p->id) }}"
                            deleteMessage="Are you sure you want to delete this item?" />
                    </div>
                </td>
            </tr>
        @endforeach
    @endcomponent

    <!-- Pagination links -->
    <div class="mt-1 mx-3 pb-2">
        {{ $pemilik->appends(['jenis_bts_page' => $jenis_bts->currentPage()])->links() }}
    </div>
</div>



