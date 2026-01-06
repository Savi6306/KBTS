@extends('admin.layout')

@section('title', 'Category Details')

@section('content')

<h3 class="fw-bold mb-3">Category Details</h3>

<a href="{{ route('admin.categories.index') }}" class="btn btn-secondary mb-3">
    ← Back to Categories
</a>

<div class="card shadow-sm">
    <div class="card-body">

        <h4 class="fw-bold mb-3">
            {{ $category->name }}
        </h4>

        <p class="mb-2">
            <strong>Icon:</strong>
            @if($category->icon)
                <i class="{{ $category->icon }}"></i> 
                <span class="ms-2">{{ $category->icon }}</span>
            @else
                <span class="text-muted">No icon</span>
            @endif
        </p>

        <p class="mb-2">
            <strong>Description:</strong><br>
            {{ $category->description ?? 'No description provided.' }}
        </p>

        <p class="mb-2">
            <strong>Status:</strong>
            <span class="badge bg-{{ $category->status == 'Active' ? 'success' : 'secondary' }}">
                {{ $category->status }}
            </span>
        </p>

        <p class="mb-2">
            <strong>Total Articles:</strong> 
            <span class="badge bg-info">
                {{ $category->articles_count }}
            </span>
        </p>

        <div class="mt-4">
            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary">
                Edit Category
            </a>

            <form action="{{ route('admin.categories.destroy', $category->id) }}" 
                  method="POST" 
                  class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to delete this category?')">
                    Delete
                </button>
            </form>
        </div>

    </div>
</div>

@endsection
