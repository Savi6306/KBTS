@extends('admin.layout')

@section('title','Create Article')

@section('content')

<h3 class="fw-bold mb-3">Create Article</h3>

<form method="POST" action="{{ route('admin.kb.store') }}">
    @csrf

    <label>Title</label>
    <input type="text" name="title" class="form-control mb-3" required>

    <label>Category</label>
    <select name="category_id" class="form-select mb-3">
        <option value="">None</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
    </select>

    <label>Content</label>
    <textarea name="content" rows="6" class="form-control mb-3" required></textarea>

    <label>
        <input type="checkbox" name="is_published" checked>
        Publish
    </label>

    <button class="btn btn-primary px-4 mt-3">Save</button>
</form>

@endsection
