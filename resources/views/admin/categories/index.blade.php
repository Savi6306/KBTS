@extends('admin.layout')

@section('title','Categories')

@section('content')

<h3 class="fw-bold mb-3">Categories</h3>

<a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">+ Add Category</a>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Icon</th>
            <th>Description</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
    @foreach($categories as $cat)
        <tr>
            <td>{{ $cat->id }}</td>
            <td>{{ $cat->name }}</td>
            <td>{{ $cat->icon }}</td>
            <td>{{ $cat->description }}</td>
            <td>
                <span class="badge bg-{{ $cat->status == 'Active' ? 'success' : 'secondary' }}">
                    {{ $cat->status }}
                </span>
            </td>
            <td>
                <a href="{{ route('admin.categories.edit', $cat->id) }}"
                   class="btn btn-sm btn-info">Edit</a>

                <form action="{{ route('admin.categories.destroy', $cat->id) }}"
                      method="POST"
                      class="d-inline">
                    @csrf 
                    @method('DELETE')
                    
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

{{ $categories->links() }}

@endsection
