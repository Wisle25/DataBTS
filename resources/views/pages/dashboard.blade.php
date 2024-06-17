@extends('components.layout.index')
@section('content')

    @include('components.allert.success')

    {{-- ISI DASHBOARD --}}
    <div class="mt-1 flex flex-wrap -mx-6">
        {{-- DASHBOARD - PEMILIK --}}
        <div class="w-full pl-4 sm:w-4/5 xl:w-1/2 mt-2">
            @include('pages.pemilik.index')
        </div>

        {{-- DASHBOARD - History Login --}}
        {{-- <div class="w-full px-6 sm:w-4/5 xl:w-1/2 mt-2">
            <div class="items-center px-5 py-6 bg-violet-200 rounded-md shadow-sm">
                <h5>History Login</h5>
                @component('components.table.index', ['columns' => ['No', 'Username', 'Email'],])
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
                        ];
                    @endphp
                    @foreach ($btsData as $index => $bts)
                        <tr>
                            <td class="px-5 py-2 text-center">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 text-center">{{ $bts['nama'] }}</td>
                            <td class="px-4 py-2 text-center">{{ $bts['email'] }}</td>
                            <td class="px-4 py-2 text-center">
            
                                <x-button.btn-action 
                                    edit-url=""
                                    delete-url="" delete-message="Yakin akan menghapus data?" />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endcomponent
            </div>
        </div> --}}

        <div class="w-full px-6 sm:w-4/5 xl:w-1/2 mt-2">
            @include('pages.kuesioner.index')
        </div>

        <div class="w-full pl-4 sm:w-4/5 xl:w-1/2 mt-4">
            @include('pages.jenis_bts.index')
        </div>

        @component('components.allert.modal')
            Data
        @endcomponent
        

        <div class="mt-8"></div>
    @endsection
