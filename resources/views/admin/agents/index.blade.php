@extends('admin.layout')

@section('title','Agents')

@section('content')

<h3 class="fw-bold mb-3">Agents</h3>

<a href="{{ route('admin.agents.create') }}" class="btn btn-primary mb-3">
    + Add Agent
</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Assigned Tickets</th>
            <th>Joined</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
    @foreach($agents as $agent)
        <tr>
            <td>{{ $agent->id }}</td>
            <td>{{ $agent->name }}</td>
            <td>{{ $agent->email }}</td>

            {{-- IMPORTANT: SAFE COUNT --}}
            <td>{{ $agent->assignedTickets?->count() ?? 0 }}</td>

            <td>{{ $agent->created_at->format('d M Y') }}</td>

            <td>
                <a href="{{ route('admin.agents.show', $agent->id) }}"
                   class="btn btn-sm btn-info">
                    View
                </a>

                <form action="{{ route('admin.agents.destroy',$agent->id) }}"
                      method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-sm btn-danger"
                              onclick="return confirm('Delete agent?')">
                        Delete
                      </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $agents->links() }}

@endsection
