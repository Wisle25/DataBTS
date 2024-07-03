@extends('components.layout.index')

@section('content')
    <div class="items-center px-2 pt-3 bg-violet-200 rounded-md shadow-sm h-96 relative">
        <div class="flex">
            <p class="ml-4 mr-1 text-xl font-semibold">Kuesioner</p>
            @component('components.section.export', ['route' => route('kuesioner.exportExcel')])
                Export Excel
            @endcomponent
            @component('components.section.export', ['route' => route('kuesioner.exportPdf')])
                Export Pdf
            @endcomponent
        </div>

        @if($kuesioners->isEmpty())
            <div class="py-6 w-full h-full relative">
                <p class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-white font-bold text-2xl">Anda belum mempunyai Kuesioner</p>
            </div>
        @else
            @component('components.table.index', [
                'columns' => ['No', 'Subjek', 'Pertanyaan'],
            ])
                @foreach ($kuesioners as $index => $k)
                    <tr class="hover:bg-gray-100 cursor-pointer" onclick="showDetailsK({{ json_encode($k) }})">
                        <td class="px-4 py-1 text-center">{{ ($kuesioners->currentPage() - 1) * $kuesioners->perPage() + $index + 1 }}</td>
                        <td class="px-4 py-1 text-center">{{ $k['subjek'] }}</td>
                        <td class="px-4 py-1 text-center">{{ $k['pertanyaan'] }}</td>
                        <td class="px-4 py-1 text-center" onclick="event.stopPropagation();">
                            <div class="flex justify-center">
                                <x-button.btn-action 
                                    editUrl="{{ url('kuesioner/' . $k['id'] . '/edit') }}"
                                    deleteUrl="{{ url('kuesioner/' . $k['id']) }}"
                                    deleteMessage="Are you sure you want to delete this item?" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endcomponent

            <!-- Pagination links -->
            <div class="absolute w-[97.3%] bottom-0 mt-1 mx-3 pb-2">
                {{ $kuesioners->links() }}
            </div>
        @endif
    </div>

    <a href="{{ url('kuesioner/create') }}" class="w-full mx-auto p-2 bg-violet-200 hover:bg-violet-300 rounded-md mt-3 cursor-pointer text-center block font-bold">
        Tambahkan Kuesioner
    </a>

    <!-- Modal -->
    <div id="detailModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- Modal content -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                    <h3 class="text-lg font-medium leading-6 text-gray-900" id="modalTitle">Detail Kuesioner</h3>
                    <div class="mt-2" id="modalContent">
                        <!-- Details will be populated here -->
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" class="w-full px-4 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeModal()">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function formatDate(dateString) {
        const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
        return new Date(dateString).toLocaleDateString('en-GB', options); // en-GB for DD/MM/YYYY format
    }

    function showDetailsK(k) {
        const modal = document.getElementById('detailModal');
        const modalContent = document.getElementById('modalContent');

        modalContent.innerHTML = `
        <div class="p-4">
            <h3 class="text-xl text-center font-bold mb-2 uppercase">${k.subjek}</h3>
            <div class="flex justify-between w-full text-xs">
                <div class="text-gray-600 mb-2">
                    <h2>Created At:</h2>
                    <p>${formatDate(k.created_at)}</p>
                </div>
                <div class="text-gray-600 mb-4">
                    <h2>Edited At:</h2>
                    <p>${formatDate(k.edited_at)}</p>
                </div>
            </div>
            <div>
                <h2>Pertanyaan:</h2>
                <p class="h-24">${k.pertanyaan}</p>
            </div>
        </div>
        `;

        modal.classList.remove('hidden');
    }

    function closeModal() {
        const modal = document.getElementById('detailModal');
        modal.classList.add('hidden');
    }
</script>
