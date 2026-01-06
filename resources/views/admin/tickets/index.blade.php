@extends('admin.layout')

@section('title','Tickets')

@section('content')

<h2 class="fw-bold mb-3">All Tickets</h2>

<div class="admin-card mb-4 p-3">

<form method="GET" class="row g-3">

    {{-- Search --}}
    <div class="col-md-3">
        <input type="text" name="q" class="form-control"
               placeholder="Search subject or user..."
               value="{{ request('q') }}">
    </div>

    {{-- Status --}}
    <div class="col-md-2">
        <select name="status" class="form-select">
            <option value="">All Status</option>
            <option value="New" {{ request('status')=='New'?'selected':'' }}>New</option>
            <option value="In Progress" {{ request('status')=='In Progress'?'selected':'' }}>In Progress</option>
            <option value="Resolved" {{ request('status')=='Resolved'?'selected':'' }}>Resolved</option>
            <option value="Closed" {{ request('status')=='Closed'?'selected':'' }}>Closed</option>
        </select>
    </div>

    {{-- Priority --}}
    <div class="col-md-2">
        <select name="priority" class="form-select">
            <option value="">Priority</option>
            <option value="High" {{ request('priority')=='High'?'selected':'' }}>High</option>
            <option value="Medium" {{ request('priority')=='Medium'?'selected':'' }}>Medium</option>
            <option value="Low" {{ request('priority')=='Low'?'selected':'' }}>Low</option>
        </select>
    </div>

    {{-- Category --}}
    <div class="col-md-2">
        <select name="category" class="form-select">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" 
                    {{ request('category') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Agent Filter --}}
    <div class="col-md-3">
        <select name="agent" class="form-select">
            <option value="">All Agents</option>
            @foreach($agents as $ag)
                <option value="{{ $ag->id }}" 
                    {{ request('agent')==$ag->id?'selected':'' }}>
                    {{ $ag->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Filter Button --}}
    <div class="col-md-2">
        <button class="btn btn-primary w-100">Filter</button>
    </div>

    {{-- Reset Button --}}
    <div class="col-md-2">
        <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary w-100">
            Reset
        </a>
    </div>

</form>

</div>



<div class="admin-card p-0">
<table class="table table-hover align-middle mb-0">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>Subject</th>
            <th>User</th>
            <th>Agent</th>
            <th>Status</th>
            <th>Priority</th>
            <th>Category</th>
            <th>Created</th>
            <th></th>
        </tr>
    </thead>

    <tbody>

    @forelse($tickets as $t)
        <tr>
            <td>#{{ $t->id }}</td>

            <td class="fw-semibold">{{ $t->subject }}</td>

            <td title="{{ $t->user->email }}">
                {{ $t->user->name }}
            </td>

            <td>
                <span class="badge bg-secondary">
                    {{ $t->agent->name ?? 'Unassigned' }}
                </span>
            </td>

            {{-- Status --}}
            <td>
                <span class="badge 
                    @if($t->status=='New') bg-info
                    @elseif($t->status=='In Progress') bg-warning text-dark
                    @elseif($t->status=='Resolved') bg-success
                    @else bg-danger @endif">
                    {{ $t->status }}
                </span>
            </td>

            {{-- Priority --}}
            <td>
                <span class="badge 
                    @if($t->priority=='High') bg-danger
                    @elseif($t->priority=='Medium') bg-warning text-dark
                    @else bg-success @endif">
                    {{ $t->priority }}
                </span>
            </td>

            {{-- CATEGORY --}}
            <td>
                <span class="badge bg-dark">
                    {{ $t->category->name ?? '—' }}
                </span>
            </td>

            <td>{{ $t->created_at->format('d M, Y') }}</td>

            <td>
                <a href="{{ route('admin.tickets.show',$t->id) }}"
                   class="btn btn-sm btn-outline-primary">
                   View
                </a>
            </td>

        </tr>
    @empty
        <tr>
            <td colspan="9" class="text-center text-muted py-4">
                No tickets found.
            </td>
        </tr>
    @endforelse

    </tbody>

</table>

<div class="p-3">
    {{ $tickets->links() }}
</div>

</div>

@endsection
