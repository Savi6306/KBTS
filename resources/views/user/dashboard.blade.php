@extends('user.layout')

@section('title', 'Dashboard')

@section('content')

<style>

    /* ======== SUPER PREMIUM DESIGN ======== */

    .page-title {
        font-size: 28px;
        font-weight: 800;
        color: #1d3557;
    }

    .welcome-card {
        background: linear-gradient(135deg, #dbeafe, #f0f9ff);
        border-radius: 18px;
        padding: 28px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.07);
    }

    .stats-card {
        border-radius: 18px;
        padding: 25px;
        background: #ffffff;
        position: relative;
        box-shadow: 0px 6px 18px rgba(0,0,0,0.10);
        transition: 0.3s;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 10px 24px rgba(0,0,0,0.15);
    }

    .stats-icon {
        font-size: 40px;
        position: absolute;
        right: 20px;
        top: 20px;
        opacity: 0.15;
    }

    .stats-title {
        font-size: 14px;
        font-weight: 700;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .stats-number {
        font-size: 48px;
        font-weight: 800;
        margin-top: 15px;
    }

    .primary { color: #1a73e8; }
    .warning { color: #f39c12; }
    .success { color: #27ae60; }

    .quick-box {
        padding: 20px;
        border-radius: 14px;
        background: #ffffff;
        text-align: center;
        box-shadow: 0px 5px 16px rgba(0,0,0,0.1);
        transition: 0.3s;
        cursor: pointer;
    }
    .quick-box:hover {
        transform: translateY(-4px);
        box-shadow: 0px 8px 20px rgba(0,0,0,0.15);
    }
    .quick-icon {
        font-size: 35px;
        margin-bottom: 8px;
        color: #0d6efd;
    }

    .ticket-card {
        background: #ffffff;
        padding: 20px;
        border-radius: 14px;
        box-shadow: 0 5px 18px rgba(0,0,0,0.08);
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

    .view-btn {
        background: #0d6efd;
        color: white;
        padding: 5px 12px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 13px;
    }

    .reply-card {
        padding: 18px;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0px 5px 18px rgba(0,0,0,0.08);
        margin-bottom: 12px;
    }

    .reply-user {
        font-weight: bold;
        color: #23428c;
        font-size: 15px;
    }

    .reply-msg {
        font-size: 14px;
        color: #555;
    }

</style>

<div class="mb-4">
    <h2 class="page-title">User Dashboard</h2>
    <p class="text-muted">Your complete support overview</p>
</div>

<div class="welcome-card mb-4">
    <h4 class="fw-bold mb-1">Hello, {{ Auth::user()->name }} 👋</h4>
    <p class="text-muted">Here’s a summary of your ticket activity.</p>
</div>

<div class="row g-4">

    <div class="col-md-4">
        <div class="stats-card">
            <i class="bi bi-folder2-open stats-icon"></i>
            <div class="stats-title">Total Tickets</div>
            <div class="stats-number primary">{{ $totalTickets }}</div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stats-card">
            <i class="bi bi-hourglass-split stats-icon"></i>
            <div class="stats-title">Pending Tickets</div>
            <div class="stats-number warning">{{ $pendingTickets }}</div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stats-card">
            <i class="bi bi-check-circle stats-icon"></i>
            <div class="stats-title">Resolved Tickets</div>
            <div class="stats-number success">{{ $resolvedTickets }}</div>
        </div>
    </div>

</div>

<h4 class="fw-bold mt-5 mb-3">Quick Actions</h4>

<div class="row g-4 mb-4">

    <div class="col-md-4">
        <a href="{{ route('user.tickets.create') }}" class="text-decoration-none">
            <div class="quick-box">
                <i class="bi bi-plus-circle quick-icon"></i>
                <div class="fw-bold">Create Ticket</div>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="{{ route('user.tickets.index') }}" class="text-decoration-none">
            <div class="quick-box">
                <i class="bi bi-ticket-detailed quick-icon"></i>
                <div class="fw-bold">View My Tickets</div>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="{{ route('user.kb.index') }}" class="text-decoration-none">
            <div class="quick-box">
                <i class="bi bi-journal-text quick-icon"></i>
                <div class="fw-bold">Knowledge Base</div>
            </div>
        </a>
    </div>

</div>

<div class="row g-4">

    <div class="col-md-6">

        <h4 class="fw-bold mb-3">Recent Tickets</h4>

        <div class="ticket-card p-0">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($recentTickets as $t)
                    <tr>
                        <td>{{ $t->subject }}</td>

                        <td><span class="badge-status status-{{ strtolower($t->status) }}">{{ $t->status }}</span></td>

                        <td><span class="badge-status priority-{{ strtolower($t->priority) }}">{{ $t->priority }}</span></td>

                        <td>
                            <a href="{{ route('user.tickets.show', $t->id) }}" class="view-btn">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>

    <div class="col-md-6">
        <h4 class="fw-bold mb-3">Recent Replies</h4>

        @forelse($recentReplies as $reply)
        <div class="reply-card">
            <div class="reply-user">{{ $reply->user->name }}</div>
            <div class="reply-msg">{{ Str::limit($reply->content, 120) }}</div>
            <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
        </div>
        @empty
            <p class="text-muted">No replies yet.</p>
        @endforelse

    </div>

</div>

<div class="mt-5 p-3 ticket-card">
    <h4 class="fw-bold mb-3">Ticket Activity Graph</h4>
    <canvas id="ticketChart" height="200"></canvas>
</div>

@endsection

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
var ctx = document.getElementById('ticketChart').getContext('2d');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($chartLabels) !!},
        datasets: [{
            label: 'Tickets Created',
            data: {!! json_encode($chartData) !!},
            borderWidth: 3
        }]
    }
});
</script>

@endsection
