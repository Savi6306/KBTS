@extends('admin.layout')

@section('title', 'Edit User')

@section('content')

<div class="admin-card">
    <h3 class="fw-bold mb-3">Edit User</h3>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-bold">Full Name</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Role</label>
            <select name="role" class="form-select">
                <option value="user" {{ $user->role=='user'?'selected':'' }}>User</option>
                <option value="agent" {{ $user->role=='agent'?'selected':'' }}>Agent</option>
                <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>

@endsection
