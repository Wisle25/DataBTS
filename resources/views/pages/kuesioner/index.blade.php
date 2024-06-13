<div class="items-center px-3 py-3 bg-violet-200 rounded-md shadow-sm">
    <div class="flex">
        <p class="mx-4 text-xl font-semibold">Kuesioner</p>
        {{-- Tombol tambah data --}}
        <div class="ms-auto">
            @component('components.button.btn-tambah', ['url' => url('kuesioner/create')])
            @endcomponent
        </div>
    </div>

    @component('components.table.index', [
        'columns' => ['No', 'Pertanyaan'],
    ])
        @foreach ($kuesioner as $index => $k)
            <tr class="hover:bg-gray-100 cursor-pointer" onclick="showDetailsK({{ json_encode($k) }})">
                <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                <td class="px-4 py-2 text-center">{{ $k['pertanyaan'] }}</td>
                <td class="px-4 py-2 text-center" onclick="event.stopPropagation();">
                    <div class="flex justify-center">
                        <x-button.btn-action editUrl="{{ url('kuesioner/' . $k['id'] . '/edit') }}"
                            deleteUrl="{{ url('kuesioner/' . $k['id']) }}"
                            deleteMessage="Are you sure you want to delete this item?" />
                    </div>
                </td>
            </tr>
        @endforeach
    @endcomponent
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
