@extends('admin.layout')

@section('title','Create Category')

@section('content')

<h3 class="fw-bold mb-3">Create Category</h3>

{{-- Flash Message --}}
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- Validation Errors --}}
@if ($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
</div>
@endif

<form method="POST" action="{{ route('admin.categories.store') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label">Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control" placeholder="Enter category name" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Icon</label>
        <input type="text" name="icon" class="form-control" placeholder="FontAwesome / Bootstrap icon class">
        <small class="text-muted">Example: fa fa-user, bi bi-ticket</small>
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="4" placeholder="Describe the category (optional)"></textarea>
    </div>

    {{-- Optional: Status field (PDF me hota hai) --}}
    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="Active" selected>Active</option>
            <option value="Inactive">Inactive</option>
        </select>
    </div>

    <button class="btn btn-primary px-4">Save</button>
</form>

@endsection
