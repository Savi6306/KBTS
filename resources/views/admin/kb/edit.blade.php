@extends('admin.layout')

@section('title','Edit Article')

@section('content')

<h3 class="fw-bold mb-3">Edit Article</h3>

<form method="POST" action="{{ route('admin.kb.update', $article->id) }}">
    @csrf
    @method('PUT')

    <label>Title</label>
    <input type="text" name="title" value="{{ $article->title }}" class="form-control mb-3" required>

    <label>Category</label>
    <select name="category_id" class="form-select mb-3">
        <option value="">None</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}"
                {{ $article->category_id == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>

    <label>Content</label>
    <textarea name="content" rows="6" class="form-control mb-3" required>{{ $article->content }}</textarea>

    <label>
        <input type="checkbox" name="is_published" {{ $article->is_published ? 'checked' : '' }}>
        Publish
    </label>

    <button class="btn btn-primary px-4 mt-3">Update</button>
</form>

@endsection
