@extends('agent.layout')

@section('title','Tickets')

@section('content')

<style>
    body {
        background: #f4f6f9;
    }

    .ticket-card {
        background: #ffffff;
        border-radius: 14px;
        padding: 25px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        border: 1px solid #e5e7eb;
    }

    thead {
        background: #f9fafb;
        border-bottom: 2px solid #e5e7eb;
    }

    tbody tr:hover {
        background: #f8f9fc;
    }

    .status-badge {
        padding: 5px 12px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 600;
    }
    .status-new { background:#e8f0fe; color:#1a73e8; }
    .status-progress { background:#fff6db; color:#b7791f; }
    .status-resolved { background:#e6f6e9; color:#1b8f3a; }
    .status-closed { background:#fde7e9; color:#d93025; }

    .priority-high { color:#d93025; font-weight:700; }
    .priority-medium { color:#ef6c00; font-weight:700; }
    .priority-low { color:#1b8f3a; font-weight:700; }

    .btn-view {
        background: #4f46e5;
        border: none;
        color: white;
        padding: 6px 14px;
        border-radius: 6px;
        font-weight: 600;
    }
    .btn-view:hover {
        background: #4338ca;
    }

    .badge-admin {
        background: #1d4ed8;
        color: #fff;
        padding: 3px 10px;
        border-radius: 30px;
        font-size: 11px;
    }
</style>

<h3 class="fw-bold mb-3">Assigned Tickets</h3>

{{-- FILTERS --}}
<div class="ticket-card mb-3">

<form method="GET" class="row g-3">

    {{-- Search --}}
    <div class="col-md-3">
        <input type="text" name="search" class="form-control"
               placeholder="Search subject..."
               value="{{ request('search') }}">
    </div>

    {{-- Status --}}
    <div class="col-md-2">
        <select name="status" class="form-select">
            <option value="">All Status</option>
            @foreach($statuses as $st)
                <option value="{{ $st }}" {{ request('status')==$st?'selected':'' }}>
                    {{ $st }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Priority --}}
    <div class="col-md-2">
        <select name="priority" class="form-select">
            <option value="">All Priority</option>
            <option value="High" {{ request('priority')=='High'?'selected':'' }}>High</option>
            <option value="Medium" {{ request('priority')=='Medium'?'selected':'' }}>Medium</option>
            <option value="Low" {{ request('priority')=='Low'?'selected':'' }}>Low</option>
        </select>
    </div>

    {{-- From Date --}}
    <div class="col-md-2">
        <input type="date" name="from" class="form-control"
               value="{{ request('from') }}">
    </div>

    {{-- To Date --}}
    <div class="col-md-2">
        <input type="date" name="to" class="form-control"
               value="{{ request('to') }}">
    </div>

    <div class="col-md-1">
        <button class="btn btn-primary w-100">Go</button>
    </div>

</form>

</div>

{{-- TICKET TABLE --}}
<div class="ticket-card">

    <table class="table table-borderless align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Subject</th>
                <th>User</th>
                <th>Category</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Assigned By</th>
                <th class="text-end">Action</th>
            </tr>
        </thead>

        <tbody>

        @forelse($tickets as $t)
            <tr>

                <td>#{{ $t->id }}</td>

                <td class="fw-semibold">
                    {{ $t->subject }}
                </td>

                {{-- USER NAME + EMAIL TOOLTIP --}}
                <td>
                    <span data-bs-toggle="tooltip" title="{{ $t->user->email }}">
                        {{ $t->user->name }}
                    </span>
                </td>

                {{-- CATEGORY --}}
                <td>
                    {{ $t->category->name ?? '—' }}
                </td>

                {{-- STATUS --}}
                <td>
                    <span class="status-badge
                        {{ $t->status=='New'?'status-new':'' }}
                        {{ $t->status=='In Progress'?'status-progress':'' }}
                        {{ $t->status=='Resolved'?'status-resolved':'' }}
                        {{ $t->status=='Closed'?'status-closed':'' }}">
                        {{ $t->status }}
                    </span>
                </td>

                {{-- PRIORITY --}}
                <td>
                    <span class="
                        {{ $t->priority=='High'?'priority-high':'' }}
                        {{ $t->priority=='Medium'?'priority-medium':'' }}
                        {{ $t->priority=='Low'?'priority-low':'' }}">
                        {{ $t->priority }}
                    </span>
                </td>

                {{-- ASSIGNED BY ADMIN BADGE --}}
                <td>
    <span class="badge-admin">
        {{ $t->agent_id ? 'Admin' : 'Admin' }}
    </span>
</td>

                <td class="text-end">
                    <a href="{{ route('agent.tickets.show',$t->id) }}" class="btn-view btn-sm">
                        View
                    </a>
                </td>

            </tr>

        @empty
            <tr>
                <td colspan="8" class="text-center text-muted py-4">
                    No tickets found.
                </td>
            </tr>
        @endforelse

        </tbody>
    </table>

    <div class="mt-3">
        {{ $tickets->links() }}
    </div>

</div>

{{-- TOOLTIP --}}
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

@endsection
