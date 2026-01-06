@extends('admin.layout')

@section('title','Add Agent')

@section('content')

<h3 class="fw-bold mb-3">Add New Agent</h3>

{{-- Show Validation Errors --}}
@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Show Session Error --}}
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

{{-- Show Success Message --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('admin.agents.store') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name"
               class="form-control"
               value="{{ old('name') }}"
               required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email"
               class="form-control"
               value="{{ old('email') }}"
               required>
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password"
               class="form-control"
               required>
    </div>

    <button class="btn btn-success px-4">Create Agent</button>
</form>

@endsection
