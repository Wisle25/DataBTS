<div class="items-center px-3 py-3 bg-violet-200 rounded-md shadow-sm">
    <div class="flex">
        <p class="mx-4 text-xl font-semibold">Pemilik</p>
        {{-- Tombol tambah data --}}
        <div class="ms-auto">
            @component('components.button.btn-tambah', ['url' => url('pemilik/create')])
            @endcomponent
        </div>
    </div>
    @component('components.table.index', [
        'columns' => ['No', 'Nama'],
    ])
        @foreach ($pemilik as $index => $p)
            <tr class="hover:bg-gray-100 cursor-pointer" onclick="showDetails({{ json_encode($p) }})">
                <td class="px-5 py-2 text-center">{{ $index + 1 }}</td>
                <td class="px-4 py-2 text-center">{{ $p['name'] }}</td>
                <td class="px-4 py-2 text-center" onclick="event.stopPropagation();">
                    <div class="flex justify-center items-center space-x-2">
                        <x-button.btn-action editUrl="{{ url('pemilik/' . $p['id'] . '/edit') }}"
                            deleteUrl="{{ url('pemilik/' . $p['id']) }}"
                            deleteMessage="Are you sure you want to delete this item?" />
                    </div>
                </td>
            </tr>
        @endforeach
    @endcomponent
</div>



<script>
    function showDetails(p) {
        const modal = document.getElementById('detailModal');
        const modalContent = document.getElementById('modalContent');

        modalContent.innerHTML = `
        <table class="border-collapse">
            <tr>
                <td class="px-4 py-1">Nama</td>
                <td class="px-4 py-3">${p.name}</td>
            </tr>
            <tr>
                <td class="px-4 py-4">Alamat</td>
                <td class="px-4 py-4">${p.alamat}</td>
            </tr>
            <tr>
                <td class="px-4 py-3">Telepon</td>
                <td class="px-4 py-3">${p.telepon}</td>
            </tr>
            <tr>
                <td class="px-4 py-3">Created At</td>
                <td class="px-4 py-3">${p.created_at}</td>
                </tr>
            <tr>
                <td class="px-4 py-3">Edited At</td>
                <td class="px-4 py-3">${p.edited_at}</td>
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
