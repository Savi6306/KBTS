@extends('admin.layout')

@section('title', 'Ticket Details')

@section('content')

<h3 class="fw-bold mb-3">Ticket #{{ $ticket->id }}</h3>

{{-- FLASH --}}
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $e)
            <div>{{ $e }}</div>
        @endforeach
    </div>
@endif

{{-- DETAILS CARD --}}
<div class="card p-3 mb-4">

    <h4>{{ $ticket->subject }}</h4>

    <p>{{ $ticket->description }}</p>

    <p class="mb-0">
        <strong>User:</strong> {{ $ticket->user->name }} <br>
        <strong>Email:</strong> {{ $ticket->user->email }} <br>
        <strong>Status:</strong> {{ $ticket->status }} <br>
        <strong>Priority:</strong> {{ $ticket->priority }} <br>
         <strong>Category:</strong> {{ $ticket->category->name ?? '—' }} <br>
        <strong>Created:</strong> {{ $ticket->created_at->format('d M Y, H:i') }} <br>
        @if($ticket->close_reason)
            <strong>Close Reason:</strong> {{ $ticket->close_reason }}
        @endif
    </p>

</div>

{{-- STATUS UPDATE --}}
<div class="card p-3 mb-3">
    <h5 class="fw-bold mb-2">Update Status</h5>

    <form method="POST" action="{{ route('admin.tickets.status',$ticket->id) }}">
        @csrf

        <div class="mb-2">
            <select name="status" class="form-select w-auto">
                <option value="New" {{ $ticket->status=="New"?'selected':'' }}>New</option>
                <option value="In Progress" {{ $ticket->status=="In Progress"?'selected':'' }}>In Progress</option>
                <option value="Resolved" {{ $ticket->status=="Resolved"?'selected':'' }}>Resolved</option>
                <option value="Closed" {{ $ticket->status=="Closed"?'selected':'' }}>Closed</option>
            </select>
        </div>

        {{-- Close Reason (only if not already closed) --}}
        @if($ticket->status != 'Closed')
            <div class="mb-2">
                <input type="text"
                       name="close_reason"
                       class="form-control"
                       placeholder="Reason for closing (optional)">
            </div>
        @endif

        <button class="btn btn-primary">Update</button>
    </form>
</div>

{{-- ASSIGN AGENT --}}
<div class="card p-3 mb-4">
    <h5 class="fw-bold mb-2">Assign Ticket to Agent</h5>

    <form method="POST" action="{{ route('admin.tickets.assign', $ticket->id) }}">
        @csrf

        <select name="agent_id" class="form-select w-auto mb-2">
            <option value="">-- Unassigned --</option>

            @foreach($agents as $ag)
                <option value="{{ $ag->id }}"
                    {{ $ticket->agent_id == $ag->id ? 'selected' : '' }}>
                    {{ $ag->name }}
                </option>
            @endforeach
        </select>

        <button class="btn btn-primary">Assign</button>
    </form>
</div>

{{-- CONVERSATION --}}
<h4 class="fw-bold mt-4 mb-2">Conversation</h4>

@forelse($ticket->replies as $reply)
    <div class="card p-2 mb-2">
        <strong>{{ $reply->user->name }}</strong> <br>
        <div>{{ $reply->content }}</div>

        {{-- Attachments --}}
        @if($reply->attachments->count())
            <div class="mt-2">
                @foreach($reply->attachments as $att)
                    <a href="{{ asset('storage/'.$att->file_path) }}" target="_blank">
                        📎 {{ $att->original_name ?? 'Download attachment' }}
                    </a><br>
                @endforeach
            </div>
        @endif

        <div class="small text-muted mt-1">
            {{ $reply->created_at->diffForHumans() }}
        </div>
    </div>
@empty
    <p class="text-muted">No conversation yet.</p>
@endforelse

{{-- ADMIN REPLY --}}
<div class="card mt-3 p-3">
    <h5 class="fw-bold mb-2">Add Reply</h5>

    <form method="POST"
          action="{{ route('admin.tickets.reply',$ticket->id) }}"
          enctype="multipart/form-data">
        @csrf

        <textarea name="content" class="form-control mb-2"
                  placeholder="Type your reply..." required></textarea>

        <div class="mb-2">
            <label class="form-label">Attachment (optional)</label>
            <input type="file" name="attachment" class="form-control">
        </div>

        <button class="btn btn-primary">Send Reply</button>
    </form>
</div>

@endsection
