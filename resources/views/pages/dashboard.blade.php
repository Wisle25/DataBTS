@extends('components.layout.index')
@section('content')
    @component('components.section.title')
        Dashboard
    @endcomponent

    {{-- ISI DASHBOARD --}}
    <div class="mt-4 flex flex-wrap -mx-4">
        <div class="w-full px-6 mt-6 sm:w-4/5 xl:w-1/2 xl:mt-5">
            {{-- DASHBOARD - PEMILIK --}}
            <div class="items-center px-5 py-6 bg-violet-200 rounded-md shadow-sm">
                <h5>Pemilik</h5>
                <button 
                    class="bg-blue-500 text-white p-2 rounded-md" 
                    onclick="location.href='{{ route('pemilik.create') }}'">
                >
                    Tambahkan pemilik
                </button>
                @component('components.table.index', [
                    'columns' => ['No', 'Nama', 'Alamat', 'Telepon']
                ])
                    @foreach ($pemilik as $index => $bts)
                        <tr>
                            <td class="px-5 py-2 text-center">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 text-center">{{ $bts['name'] }}</td>
                            <td class="px-4 py-2 text-center">{{ $bts['alamat'] }}</td>
                            <td class="px-4 py-2 text-center">{{ $bts['telepon'] }}</td>
                            <td class="px-4 py-2 text-center">
                                {{-- <a href='{{ url('bts/'.$item->id.'/edit') }}' class="btn btn-warning btn-sm">Edit</a> --}}
                                {{-- <form onsubmit="return confirm('Yakin akan menghapus data?')" class='d-inline' action="{{ url('bts/'.$item->id) }}" method="post"> --}}
            
                                <x-button.btn-action 
                                    edit-url="{{ route('pemilik.edit', $bts->id) }}"
                                    {{-- delete-url="{{ url('bts', $bts['id']) }}" delete-message="Yakin akan menghapus data?" /> --}}
                                    delete-url="{{ route("pemilik.destroy", $bts->id)}}" delete-message="Yakin akan menghapus data?" />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endcomponent
            </div>
        </div>

        {{-- DASHBOARD - History Login --}}
        <div class="w-full px-6 mt-6 sm:w-4/5 xl:w-1/2 xl:mt-5">
            <div class="items-center px-5 py-6 bg-violet-200 rounded-md shadow-sm">
                <h5>History Login</h5>
                @component('components.table.index', [
                    'columns' => ['No', 'Username', 'Email']
                ])
                    @php
                    $btsData = [
                        [
                            'nama' => 'Username 1',
                            'email' => 'Email1@gmail.com'
                        ],
                        [
                            'nama' => 'Username 2',
                            'email' => 'Email2@gmail.com'
                        ],
                        [
                            'nama' => 'Username 3',
                            'email' => 'Email3@gmail.com'
                        ]
                        // Tambahkan data lainnya di sini
                        ];
                    @endphp
                    @foreach ($btsData as $index => $bts)
                        <tr>
                            <td class="px-5 py-2 text-center">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 text-center">{{ $bts['nama'] }}</td>
                            <td class="px-4 py-2 text-center">{{ $bts['email'] }}</td>
                            <td class="px-4 py-2 text-center">
                                {{-- <a href='{{ url('bts/'.$item->id.'/edit') }}' class="btn btn-warning btn-sm">Edit</a> --}}
                                {{-- <form onsubmit="return confirm('Yakin akan menghapus data?')" class='d-inline' action="{{ url('bts/'.$item->id) }}" method="post"> --}}
            
                                <x-button.btn-action 
                                    edit-url=""
                                    {{-- delete-url="{{ url('bts', $bts['id']) }}" delete-message="Yakin akan menghapus data?" /> --}}
                                    delete-url="" delete-message="Yakin akan menghapus data?" />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endcomponent
            </div>
        </div>
        
        <div class="w-full px-6 mt-6 sm:w-4/5 xl:w-1/2 xl:mt-5">
            <div class="items-center px-5 py-6 bg-violet-200 rounded-md shadow-sm">
                <h5>Kuesioner</h5>
                <button 
                    class="bg-blue-500 text-white p-2 rounded-md" 
                    onclick="location.href='{{ route('kuesioner.create') }}'">
                >
                    Tambahkan Kuesioner
                </button>
                @component('components.table.index', [
                    'columns' => ['No', 'Pertanyaan', 'Created By'],
                ])
                    @foreach ($kuesioner as $index => $element)
                        <tr class="hover:bg-gray-100 cursor-pointer" onclick="showDetails({{ json_encode($element) }})">
                            <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 text-center">{{ $element['pertanyaan'] }}</td>
                            <td class="px-4 py-2 text-center">{{ $element['created_by'] }}</td>
                            <td class="px-4 py-2 text-center" onclick="event.stopPropagation();">
                                <div class="flex justify-center">

                                    <a href='{{ route('kuesioner.edit', $element->id) }}' class="text-teal-700 hover:text-white hover:bg-teal-600 p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </a>
                                    <form onsubmit="return confirm('Yakin akan menghapus data?')" class='d-inline ml-1 mr-2'
                                        action="{{ route('kuesioner.destroy', $element->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" name="submit" class="text-rose-700 hover:text-white hover:bg-rose-600 p-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endcomponent
            </div>
        </div>

    </div>

    <div class="mt-8"></div>
@endsection
