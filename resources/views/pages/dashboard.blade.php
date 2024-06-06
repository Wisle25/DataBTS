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
                @component('components.table.index', [
                    'columns' => ['No', 'Nama', 'Alamat', 'Telepon']
                ])
                @php
                    $btsData = [
                        [
                            'nama' => 'Pemilik 1',
                            'alamat' => 'Alamat 1',
                            'telepon' => '00000000000'
                        ],
                        [
                            'nama' => 'Pemilik 2',
                            'alamat' => 'Alamat 2',
                            'telepon' => '00000000000'
                        ],
                        [
                            'nama' => 'Pemilik 3',
                            'alamat' => 'Alamat 3',
                            'telepon' => '00000000000'
                        ]
                        // Tambahkan data lainnya di sini
                        ];
                    @endphp
                    @foreach ($btsData as $index => $bts)
                        <tr>
                            <td class="px-5 py-2 text-center">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 text-center">{{ $bts['nama'] }}</td>
                            <td class="px-4 py-2 text-center">{{ $bts['alamat'] }}</td>
                            <td class="px-4 py-2 text-center">{{ $bts['telepon'] }}</td>
                            <td class="px-4 py-2 text-center">
                                {{-- <a href='{{ url('bts/'.$item->id.'/edit') }}' class="btn btn-warning btn-sm">Edit</a> --}}
                                {{-- <form onsubmit="return confirm('Yakin akan menghapus data?')" class='d-inline' action="{{ url('bts/'.$item->id) }}" method="post"> --}}
            
                                <x-button.btn-action 
                                    edit-url="/pemilik/edit"
                                    {{-- delete-url="{{ url('bts', $bts['id']) }}" delete-message="Yakin akan menghapus data?" /> --}}
                                    delete-url="" delete-message="Yakin akan menghapus data?" />
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
    </div>

    <div class="mt-8"></div>
@endsection
