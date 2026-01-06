@extends('user.layout')

@section('title', 'My Tickets')

@section('content')

<style>

    .ticket-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .ticket-card {
        background: #ffffff;
        padding: 20px;
        border-radius: 14px;
        box-shadow: 0 5px 18px rgba(0,0,0,0.08);
    }

    .ticket-table th {
        background: #eef2ff;
        color: #23428c;
        font-weight: 700;
    }

    .badge-status {
        padding: 6px 10px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-open { background:#dcf4ff; color:#0077b6; }
    .status-pending { background:#fff3cd; color:#ad8e00; }
    .status-resolved { background:#d4f8d4; color:#176c2c; }
    .status-closed { background:#ffe0e0; color:#b30000; }

    .priority-low { background:#e8f5e9; color:#2e7d32; }
    .priority-medium { background:#fff3cd; color:#ad8e00; }
    .priority-high { background:#ffe0e0; color:#b30000; }
    .priority-critical { background:#ffd6d6; color:#990000; }
 .category-badge {
        padding: 6px 10px;
        background:#343a40;
        color:white;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
    }
    .view-btn {
        background: #0d6efd;
        color: white;
        border-radius: 8px;
        padding: 6px 14px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
    }

    .view-btn:hover {
        background: #004bca;
        color: #fff;
    }

</style>


<div class="ticket-header">
    <h2 class="fw-bold">My Tickets</h2>
     
    <a href="{{ route('user.tickets.create') }}" 
       class="btn btn-primary px-3 fw-bold">
        ➕ Create Ticket
    </a>
    <!-- New Dashboard Button -->
        <a href="{{ route('user.dashboard') }}" 
           class="btn btn-primary px-3 fw-bold">
         ← Back to Dashboard
        </a>
</div>

<div class="ticket-card">

    <table class="table table-bordered table-striped ticket-table mb-0">
        <thead>
            <tr>
                <th style="width: 60px;">ID</th>
                <th>Subject</th>
                  <th style="width: 140px;">Category</th>
                <th style="width: 120px;">Status</th>
                <th style="width: 120px;">Priority</th>
                <th style="width: 140px;">Created</th>
                <th style="width: 90px;">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($tickets as $ticket)
            <tr>
                <td class="fw-bold">#{{ $ticket->id }}</td>

                <td>{{ $ticket->subject }}</td>

                {{-- CATEGORY --}}
                <td>
                    <span class="category-badge">
                        {{ $ticket->category->name ?? '—' }}
                    </span>
                </td>
                <td>
                    <span class="badge-status 
                        @if($ticket->status=='Open') status-open 
                        @elseif($ticket->status=='Pending') status-pending 
                        @elseif($ticket->status=='Resolved') status-resolved 
                        @else status-closed @endif">
                        {{ $ticket->status }}
                    </span>
                </td>

                <td>
                    <span class="badge-status 
                        @if($ticket->priority=='Low') priority-low
                        @elseif($ticket->priority=='Medium') priority-medium
                        @elseif($ticket->priority=='High') priority-high
                        @else priority-critical @endif">
                        {{ $ticket->priority }}
                    </span>
                </td>

                <td>{{ $ticket->created_at->format('d M Y') }}</td>

                <td>
                    <a href="{{ route('user.tickets.show',$ticket->id) }}" 
                       class="view-btn">
                       View
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection
