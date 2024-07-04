@extends('components.layout.index')

@section('content')
    @include('components.allert.success')

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">User Profile</h1>

        <table class="min-w-full bg-white border border-gray-200 text-[15px]">
            <tbody>
                <tr class="bg-white hover:bg-gray-100 border-b">
                    <th class="text-left py-3 px-4 ">Nama</th>
                    <td class="text-left py-3 px-4">{{ $user->nama }}</td>
                </tr>
                <tr class="bg-white hover:bg-gray-100 border-b">
                    <th class="text-left py-3 px-4 ">Username</th>
                    <td class="text-left py-3 px-4">{{ $user->username }}</td>
                </tr>
                <tr class="bg-white hover:bg-gray-100 border-b">
                    <th class="text-left py-3 px-4 ">Email</th>
                    <td class="text-left py-3 px-4">{{ $user->email }}</td>
                </tr>
                <tr class="bg-white hover:bg-gray-100 border-b">
                    <th class="text-left py-3 px-4 ">Peran</th>
                    <td class="text-left py-3 px-4">{{ $user->peran }}</td>
                </tr>
                <tr class="bg-white hover:bg-gray-100 border-b">
                    <th class="text-left py-3 px-4  ">Status</th>
                    <td class="text-left py-3 px-4">{{ $user->status }}</td>
                </tr>
            </tbody>
        </table>
        <div class="mt-4 flex">
            <a href="{{ route('profile.edit') }}"
                class="mx-3 px-3 py-1.5  bg-teal-600 text-white rounded-lg text-[15px] cursor-pointer active:scale-[.97]">Edit
                Profile</a>
            <form action="{{ route('profile.delete') }}" method="POST" class="ml-2 inline-block">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="mx-1 px-3 py-1.5 bg-red-500 text-white rounded-lg text-[15px] cursor-pointer active:scale-[.97]"
                    onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">Delete
                    Account</button>
            </form>
            <!-- Tombol Back -->
            <div class="ms-auto">
                <a href="{{ url('/') }}" class="px-3 py-1.5 bg-blue-500 text-white rounded-md hover:bg-blue-700">Back to Home</a>
            </div>
        </div>

    </div>
@endsection
