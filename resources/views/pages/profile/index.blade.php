@extends('components.layout.index')

@section('content')
    <div class="container">
        <h1>User Profile</h1>
        <table class="table">
            <tr>
                <th>Nama</th>
                <td>{{ $user->nama }}</td>
            </tr>
            <tr>
                <th>Username</th>
                <td>{{ $user->username }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Peran</th>
                <td>{{ $user->peran }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $user->status }}</td>
            </tr>
        </table>
        <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
        <form action="{{ route('profile.delete') }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete your profile? This action cannot be undone.')">Delete Profile</button>
        </form>
    </div>
@endsection