<div class="items-center px-2 pt-3 bg-violet-200 rounded-md shadow-sm">
    <div class="flex">
        <p class="ml-4 mr-1 text-xl font-semibold">Kuesioner</p>
        <x-button.btn-action-tambah :url="url('kuesioner/create')" />
        <div class="ms-auto flex">
            @component('components.section.exportExcel', ['route' => route('kuesioner.exportExcel')])
                Export Excel
            @endcomponent
            @component('components.section.exportPdf', ['route' => route('kuesioner.exportPdf')])
                Export Pdf
            @endcomponent
        </div>
    </div>

    @component('components.table.index', [
        'columns' => ['No', 'Pertanyaan'],
    ])
        @foreach ($kuesioner as $index => $k)
            <tr class="hover:bg-gray-100 cursor-pointer" onclick="showDetailsK({{ json_encode($k) }})">
                <td class="px-4 py-1 text-center">{{ ($kuesioner->currentPage() - 1) * $kuesioner->perPage() + $index + 1 }}
                </td>
                <td class="px-4 py-1 text-center">{{ $k['pertanyaan'] }}</td>
                <td class="px-4 py-1 text-center" onclick="event.stopPropagation();">
                    <div class="flex justify-center">
                        <x-button.btn-action editUrl="{{ url('kuesioner/' . $k['id'] . '/edit') }}"
                            deleteUrl="{{ url('kuesioner/' . $k['id']) }}"
                            deleteMessage="Are you sure you want to delete this item?" />
                    </div>
                </td>
            </tr>
        @endforeach
    @endcomponent

    <!-- Pagination links -->
    <div class="mt-1 mx-3 pb-2">
        {{ $kuesioner->appends(['pemilik_page' => $pemilik->currentPage(), 'jenis_bts_page' => $jenis_bts->currentPage()])->links() }}
    </div>
</div>


<script>
    function showDetailsK(k) {
        const modal = document.getElementById('detailModal');
        const modalContent = document.getElementById('modalContent');

        modalContent.innerHTML = `
        <table class="border-collapse">
            <tr>
                <td class="px-4 py-1">Pertanyaan</td>
                <td class="px-4 py-3">${k.pertanyaan}</td>
            </tr>
            <tr>
                <td class="px-4 py-4">Created By</td>
                <td class="px-4 py-4">${k.created_by}</td>
            </tr>
            <tr>
                <td class="px-4 py-3">Edited By</td>
                <td class="px-4 py-3">${k.edited_by}</td>
            </tr>
            <tr>
                <td class="px-4 py-3">Created At</td>
                <td class="px-4 py-3">${k.created_at}</td>
                </tr>
            <tr>
                <td class="px-4 py-3">Edited At</td>
                <td class="px-4 py-3">${k.edited_at}</td>
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
