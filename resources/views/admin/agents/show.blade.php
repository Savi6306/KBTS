@extends('admin.layout')

@section('title','Agent Details')

@section('content')

<h3 class="fw-bold mb-3">Agent: {{ $user->name }}</h3>

<div class="card p-3 mb-4">
    <h5>Email: {{ $user->email }}</h5>

    {{-- FIXED: null safe count --}}
    <h6>Assigned Tickets: {{ $user->assignedTickets?->count() ?? 0 }}</h6>

    <small>Registered: {{ $user->created_at->format('d M Y') }}</small>
</div>

<h4 class="fw-bold">Tickets Assigned</h4>

@if(($user->assignedTickets?->count() ?? 0) === 0)
    <p class="text-muted">No tickets assigned to this agent.</p>
@else
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Subject</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>

    <tbody>

    {{-- FIXED: safe loop --}}
    @foreach($user->assignedTickets ?? [] as $ticket)
        <tr>
            <td>{{ $ticket->id }}</td>
            <td>{{ $ticket->subject }}</td>
            <td>{{ $ticket->status }}</td>
            <td>
                <a href="{{ route('admin.tickets.show',$ticket->id) }}"
                   class="btn btn-sm btn-primary">
                    View Ticket
                </a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
@endif

@endsection
