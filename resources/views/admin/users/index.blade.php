@extends('admin.layout')

@section('title','Users')

@section('content')

<h2 class="fw-bold mb-3">Users</h2>

<a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">
    + Add User
</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="admin-card">
    <table class="table align-middle table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $u)
            <tr>
                <td>{{ $u->id }}</td>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->created_at->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('admin.users.edit',$u->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>

                    <form action="{{ route('admin.users.destroy',$u->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">
                            Delete
                        </button>
                    </form>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
</div>

@endsection
