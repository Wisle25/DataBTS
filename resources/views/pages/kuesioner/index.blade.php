@extends('components.layout.index')

@section('content')
    <form method="GET" action="{{ route('kuesioner.index') }}" class="flex justify-center mb-4">
        <input 
            type="text" 
            name="search" 
            placeholder="Search by subject" 
            value="{{ request('search') }}" 
            class="px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-violet-300 w-1/3 mr-2"
        >
        <button 
            type="submit" 
            class="px-4 py-2 bg-violet-500 text-white rounded-md hover:bg-violet-600 focus:outline-none focus:ring focus:border-violet-300"
        >
            Search
        </button>
    </form>
    
    <div class="items-center px-2 pt-3 bg-violet-200 rounded-md shadow-sm h-96 relative">
        <div class="flex">
            <p class="ml-4 mr-1 text-xl font-semibold">Kuesioner</p>
            @component('components.section.exportExcel', ['route' => route('kuesioner.exportExcel')])
                Export Excel
            @endcomponent
            @component('components.section.exportPdf', ['route' => route('kuesioner.exportPdf')])
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
                'actionLabel' => auth()->check() ? 'Actions' : null
            ])
                @foreach ($kuesioners as $index => $k)
                    <tr class="hover:bg-gray-100 cursor-pointer" onclick="window.location='{{ route('kuesioner.show', $k['id']) }}'">
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
@endsection
