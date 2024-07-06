<div class="items-center px-2 pt-3 bg-violet-200 rounded-md shadow-sm mr-5">
    <div class="flex">
        <p class="ml-4 mr-1 text-xl font-semibold">Wilayah</p>
        <x-button.btn-action-tambah :url="url('wilayah/create')" />
        <div class="ms-auto flex">
            @component('components.section.exportExcel', ['route' => route('wilayah.exportExcel')])
                Export Excel
            @endcomponent
            @component('components.section.exportPdf', ['route' => route('wilayah.exportPdf')])
                Export Pdf
            @endcomponent
        </div>
    </div>
    @component('components.table.index', [
        'columns' => ['No', 'Nama', 'Level', 'ID Parent'],
        'actionLabel' => auth()->check() ? 'Actions' : null,
    ])
        @foreach ($data as $index => $wilayah)
            <tr class="hover:bg-gray-100 cursor-pointer" onclick="showDetails({{ json_encode($wilayah) }})">
                <td class="px-5 py-1 text-center">{{ ($data->currentPage() - 1) * $data->perPage() + $index + 1 }}</td>
                <td class="px-4 py-1 text-center">{{ $wilayah['nama'] }}</td>
                <td class="px-4 py-1 text-center">{{ $wilayah['level'] }}</td>
                <td class="px-4 py-1 text-center">{{ $wilayah['id_parent'] }}</td>
                <td class="px-4 py-1 text-center" onclick="event.stopPropagation();">
                    <x-button.btn-action editUrl="{{ url('wilayah/' . $wilayah->id . '/edit') }}"
                        deleteUrl="{{ url('wilayah/' . $wilayah->id) }}"
                        deleteMessage="Are you sure you want to delete this item?" />
                </td>
            </tr>
        @endforeach
    @endcomponent

    <!-- Pagination links -->
    <div class="mt-1 mx-3 pb-2">
        {{ $data->appends(['jenis_bts_page' => $jenis_bts->currentPage()])->links() }}
    </div>
</div>
