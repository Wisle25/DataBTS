<div class="overflow-x-auto mx-3 pt-2.5 pb-5">
    <table class="min-w-full bg-white shadow-md overflow-hidden border border-gray-300">
        <thead class="bg-violet-100 border-b border-gray-300">
            <tr>
                @foreach ($columns as $column)
                    <th class="px-4 py-2 text-center text-xs font-medium uppercase tracking-wider">
                        <button type="button" class="flex items-center justify-center w-full focus:outline-none"
                            @click="sortTable('{{ $column }}')">
                            <span class="whitespace-nowrap">{{ $column }}</span>
                            <!-- Icon untuk indikasi pengurutan -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4 ml-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </th>
                @endforeach
                <!-- Tambahkan kolom untuk aksi -->
                <th class="px-4 py-2 text-center text-xs font-medium uppercase tracking-wider">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200 font-light text-xs">
            {{ $slot }}
        </tbody>
    </table>
</div>

<script>
    function sortTable(column) {
        // Implementasikan logika pengurutan berdasarkan kolom
        console.log('Sorting by column:', column);
        // Anda bisa menggunakan JavaScript atau framework seperti Alpine.js untuk mengatur logika pengurutan di sini
    }
</script>




{{-- <div class="flex flex-col mt-8 ">
    <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
            <table class="min-w-full overflow-hidden ">
                <thead>
                    <tr>
                        @foreach ($columns as $column)
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                {{ $column }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="bg-white">
                    {{ $slot }}
                </tbody>
            </table>
        </div>
    </div>
</div> --}}
