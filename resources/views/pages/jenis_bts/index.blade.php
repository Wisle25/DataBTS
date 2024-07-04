<div class="ml-2 items-center px-2 pt-3 bg-violet-200 rounded-md shadow-sm">

    <div class="flex">
        <p class="ml-4 mr-1 text-xl font-semibold">Jenis BTS</p>
        <x-button.btn-action-tambah :url="url('jenis_bts/create')" />
        <div class="ms-auto flex">
            @component('components.section.exportExcel', ['route' => route('jenis_bts.exportExcel')])
                Export Excel
            @endcomponent
            @component('components.section.exportPdf', ['route' => route('jenis_bts.exportPdf')])
                Export Pdf
            @endcomponent
        </div>
    </div>
    @component('components.table.index', [
        'columns' => ['No', 'Nama'],
        'actionLabel' => auth()->check() ? 'Actions' : null
    ])
        @foreach ($jenis_bts as $index => $jb)
            <tr class="hover:bg-gray-100 cursor-pointer" onclick="showDetailsJB({{ json_encode($jb) }})">
                <td class="px-5 py-1 text-center">{{ ($jenis_bts->currentPage() - 1) * $jenis_bts->perPage() + $index + 1 }}
                </td>
                <td class="px-4 py-1 text-center">{{ $jb['nama'] }}</td>
                <td class="px-4 py-1 text-center" onclick="event.stopPropagation();">
                    <div class="flex justify-center items-center space-x-2">
                        <x-button.btn-action editUrl="{{ url('jenis_bts/' . $jb['id'] . '/edit') }}"
                            deleteUrl="{{ url('jenis_bts/' . $jb['id']) }}"
                            deleteMessage="Are you sure you want to delete this item?" />
                    </div>
                </td>
            </tr>
        @endforeach
    @endcomponent

    <!-- Pagination links -->
    <div class="mt-1 mx-3 pb-2">
        {{ $jenis_bts->appends(['pemilik_page' => $pemilik->currentPage()])->links() }}
    </div>
</div>

