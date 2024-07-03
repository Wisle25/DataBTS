<div class="overflow-x-auto mx-3 pt-2.5 pb-1">
    <table class="min-w-full bg-white shadow-md overflow-hidden border border-gray-300">
        <thead class="bg-violet-100 border-b border-gray-300">
            <tr>
                @foreach ($columns as $column)
                    <th class="px-4 py-2 text-center text-xs font-medium tracking-wider">
                        <div class="flex items-center justify-center w-full focus:outline-none">
                            <span class="whitespace-nowrap">{{ $column }}</span>
                        </div>
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
