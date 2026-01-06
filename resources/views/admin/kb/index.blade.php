@extends('admin.layout')

@section('title','Knowledge Base')

@section('content')

<h3 class="fw-bold mb-3">Knowledge Base</h3>

<a href="{{ route('admin.kb.create') }}" class="btn btn-primary mb-3">+ Add Article</a>

<form method="GET" class="mb-3">
    <select name="category" class="form-select w-25">
        <option value="">All Categories</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ $category_id==$cat->id?'selected':'' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>
</form>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Category</th>
            <th>Published</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
    @foreach($articles as $a)
        <tr>
            <td>{{ $a->id }}</td>
            <td>{{ $a->title }}</td>
            <td>{{ $a->category->name ?? '--' }}</td>
            <td>{{ $a->is_published ? 'Yes' : 'No' }}</td>
            <td>
                <a href="{{ route('admin.kb.edit', $a->id) }}" class="btn btn-sm btn-info">Edit</a>

                <form action="{{ route('admin.kb.destroy', $a->id) }}"
                      method="POST"
                      class="d-inline">
                      @csrf @method('DELETE')
                      <button class="btn btn-sm btn-danger"
                        onclick="return confirm('Delete?')">
                        Delete
                      </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $articles->links() }}

@endsection
