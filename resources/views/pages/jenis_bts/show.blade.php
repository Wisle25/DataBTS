@extends('components.layout.index')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Jenis BTS: {{ $jenisBTS->nama }}</h1>

        <!-- Menambahkan jumlah BTS yang dimiliki -->
        <p class="mt-2">Jumlah BTS: {{ $jenisBTS->bts->count() }}</p>

        <h2 class="text-xl font-semibold mt-6 mb-2">Daftar BTS yang Dimiliki:</h2>
        <table class="min-w-full bg-white text-center shadow-md overflow-hidden border border-gray-400">
            <thead class="bg-violet-100 border-b border-gray-400">
                <tr>
                    <th class="px-4 py-2 border border-gray-400">Nama</th>
                    <th class="px-4 py-2 border border-gray-400">Alamat</th>
                    <th class="px-4 py-2 border border-gray-400">Wilayah</th>
                    <th class="px-4 py-2 border border-gray-400">Pemilik</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jenisBTS->bts as $bts)
                    <tr>
                        <td class="px-4 py-2 border border-gray-400">{{ $bts->nama }}</td>
                        <td class="px-4 py-2 border border-gray-400">{{ $bts->alamat }}</td>
                        <td class="px-4 py-2 border border-gray-400">{{ $bts->wilayah->nama }}</td>
                        <td class="px-4 py-2 border border-gray-400">{{ $bts->pemilik->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>  
        <!-- Tombol Back -->
        <div class="mt-4">
            <a href="{{ url()->previous() }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">Back</a>
        </div>
    </div>
@endsection
