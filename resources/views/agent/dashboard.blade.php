@extends('agent.layout')

@section('title','Dashboard')

@section('content')

<style>

    /* ======== Clean Light Professional Background ======== */
    body {
        background: linear-gradient(120deg, #ece9ff, #ffffff);
        min-height: 100vh;
    }

    .glass-container {
        max-width: 1250px;
        margin: 0 auto;
    }

    /* ======== Dashboard Title ======== */
    .dashboard-title {
        font-size: 30px;
        font-weight: 900;
        color: #4b2bb2;
        letter-spacing: .3px;
    }

    /* ======== Premium White Glass Card ======== */
    .glass-card {
        background: rgba(255,255,255,0.8);
        border-radius: 18px;
        padding: 22px;
        border: 1px solid rgba(200,200,255,0.4);
        backdrop-filter: blur(12px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        transition: 0.3s;
        color: #3b3b55;
    }

    .glass-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.12);
    }

    /* ======== Stats ======== */
    .stat-number {
        font-size: 38px;
        font-weight: 900;
        color: #4b2bb2;
    }

    .stat-label {
        font-size: 12px;
        text-transform: uppercase;
        color: #6d63b5;
        font-weight: 600;
        letter-spacing: 1.2px;
    }

    /* ======== Section Heading ======== */
    .section-heading {
        font-size: 20px;
        font-weight: 800;
        color: #4b2bb2;
        margin-bottom: 12px;
    }

    /* ======== Clean Table ======== */
    .table-glass thead th {
        border-bottom: 1px solid #e5e0ff;
        color: #4b2bb2;
        font-weight: 700;
    }

    .table-glass tbody tr:hover {
        background: rgba(140, 110, 255, 0.06);
    }

    .table-glass td {
        color: #3b3b55;
    }

    /* ======== Replies ======== */
    .reply-box {
        background: #f7f5ff;
        border-left: 4px solid #4b2bb2;
        border-radius: 8px;
        padding: 12px;
        margin-bottom: 10px;
        color: #3b3b55;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .reply-box small {
        color: #6a5fb2;
    }

    /* ======== Button ======== */
    .btn-outline-light {
        border-color: #4b2bb2;
        color: #4b2bb2;
    }

    .btn-outline-light:hover {
        background: #4b2bb2;
        color: white;
    }

</style>


<div class="glass-container">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="dashboard-title">Agent Dashboard</h3>
        <span class="badge bg-light text-dark px-3 py-2">
            Logged in as: {{ Auth::user()->name }}
        </span>
    </div>

    {{-- TOP STATS --}}
    <div class="row g-4 mb-3">

        <div class="col-md-4">
            <div class="glass-card h-100">
                <div class="stat-label">Total Assigned</div>
                <div class="stat-number text-info">{{ $totalAssigned }}</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="glass-card h-100">
                <div class="stat-label">Pending Tickets</div>
                <div class="stat-number text-warning">{{ $pendingTickets }}</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="glass-card h-100">
                <div class="stat-label">Resolved Tickets</div>
                <div class="stat-number text-success">{{ $resolvedTickets }}</div>
            </div>
        </div>

    </div>

    {{-- TODAY STATS --}}
    <div class="row g-4 mb-4">

        <div class="col-md-4">
            <div class="glass-card h-100">
                <div class="stat-label">Today New</div>
                <div class="stat-number">{{ $todayNew }}</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="glass-card h-100">
                <div class="stat-label">Today Resolved</div>
                <div class="stat-number text-success">{{ $todayResolved }}</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="glass-card h-100">
                <div class="stat-label">Today Replies</div>
                <div class="stat-number text-info">{{ $todayReplies }}</div>
            </div>
        </div>

    </div>

    {{-- CHARTS ROW --}}
    <div class="row g-4 mb-4">

        {{-- Weekly Line Chart --}}
        <div class="col-md-6">
            <div class="glass-card">
                <div class="section-heading mb-2">Weekly Ticket Activity</div>
                <canvas id="weekChart" height="180"></canvas>
            </div>
        </div>

        {{-- Priority Pie --}}
        <div class="col-md-3">
            <div class="glass-card">
                <div class="section-heading mb-2">Priority Split</div>
                <canvas id="priorityChart"></canvas>
            </div>
        </div>

        {{-- Status Bar --}}
        <div class="col-md-3">
            <div class="glass-card">
                <div class="section-heading mb-2">Status Overview</div>
                <canvas id="statusChart"></canvas>
            </div>
        </div>

    </div>

    {{-- RECENT TICKETS & REPLIES --}}
    <div class="row g-4 mb-4">

        {{-- Recent Tickets --}}
        <div class="col-md-7">
            <div class="glass-card">
                <div class="section-heading">Recent Tickets</div>

                @if($recentTickets->isEmpty())
                    <p class="text-muted">No recent tickets.</p>
                @else
                    <table class="table table-sm table-glass align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($recentTickets as $t)
                            <tr>
                                <td>{{ $t->subject }}</td>
                                <td>
                                    <span class="badge 
                                        @if($t->status=='New') bg-info
                                        @elseif($t->status=='In Progress') bg-warning text-dark
                                        @elseif($t->status=='Resolved') bg-success
                                        @else bg-danger
                                        @endif">
                                        {{ $t->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('agent.tickets.show',$t->id) }}"
                                       class="btn btn-sm btn-outline-light">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>

        {{-- Recent Replies --}}
        <div class="col-md-5">
            <div class="glass-card">
                <div class="section-heading">Recent Replies</div>

                @forelse($recentReplies as $r)
                    <div class="reply-box">
                        <strong>{{ $r->user->name }}</strong><br>
                        <span>{{ $r->content }}</span><br>
                        <small>{{ $r->created_at->diffForHumans() }}</small>
                    </div>
                @empty
                    <p class="text-muted">No recent replies.</p>
                @endforelse

            </div>
        </div>

    </div>

</div>

@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // WEEKLY LINE
    const weekCtx = document.getElementById('weekChart');
    new Chart(weekCtx, {
        type: 'line',
        data: {
            labels: @json($weekLabels),
            datasets: [{
                label: 'Tickets',
                data: @json($weekData),
                borderWidth: 3,
                tension: 0.4
            }]
        }
    });

    // PRIORITY PIE
    const priorityCtx = document.getElementById('priorityChart');
    new Chart(priorityCtx, {
        type: 'doughnut',
        data: {
            labels: @json($priorityLabels),
            datasets: [{
                data: @json($priorityData),
                borderWidth: 1
            }]
        }
    });

    // STATUS BAR
    const statusCtx = document.getElementById('statusChart');
    new Chart(statusCtx, {
        type: 'bar',
        data: {
            labels: @json($statusLabels),
            datasets: [{
                label: 'Tickets',
                data: @json($statusData),
                borderWidth: 1
            }]
        }
    });
</script>
@endsection
