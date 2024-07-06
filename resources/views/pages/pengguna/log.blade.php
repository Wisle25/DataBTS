@extends('components.layout.index')

@section('content')
<div class="container">
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Login Log for: {{ $pengguna->nama }} | {{ $pengguna->username }}</h1>
        <p class="mt-2">Jumlah Login: {{ $logs->count() }}</p>

        <table class="min-w-full bg-white text-center shadow-md overflow-hidden border border-gray-400">
            <thead class="bg-violet-100 border-b border-gray-400">
                <tr>
                    <th class="px-4 py-2 border border-gray-400">IP</th>
                    <th class="px-4 py-2 border border-gray-400">Login Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                    <tr>
                        <td class="px-4 py-2 border border-gray-400">{{ $log->ip_address }}</td>
                        <td class="px-4 py-2 border border-gray-400">{{ $log->login_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>   
        <!-- Tombol Back -->
        <div class="mt-4">
            <a href="{{ url()->previous() }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">Back</a>
        </div>
    </div>
</div>
@endsection
