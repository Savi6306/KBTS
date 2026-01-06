@extends('agent.layout')

@section('title','Ticket #'.$ticket->id)

@section('content')

<style>
    body {
        background: #f3f4f7;
    }

    .ticket-wrapper {
        max-width: 1050px;
        margin: 0 auto;
    }

    /* Top Ticket Info Card */
    .ticket-box {
        background: #ffffff;
        padding: 20px 24px;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        border: 1px solid #e5e7eb;
    }

    .ticket-meta small {
        color: #6b7280;
    }

    /* Chat Area */
    .chat-container {
        background: #e5ddd5;            /* WhatsApp-like bg tone */
        border-radius: 16px;
        margin-top: 22px;
        padding: 16px;
        height: 430px;
        overflow-y: auto;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        border: 1px solid #dadada;
    }

    .chat-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .chat-msg {
        max-width: 70%;
        padding: 8px 12px;
        border-radius: 12px;
        font-size: 14px;
        line-height: 1.4;
        position: relative;
    }

    /* User (Customer) bubble – left */
    .from-user {
        align-self: flex-start;
        background: #ffffff;
        border-radius: 12px 12px 12px 0;
        box-shadow: 0 1px 2px rgba(0,0,0,0.2);
    }

    /* Agent bubble – right */
    .from-agent {
        align-self: flex-end;
        background: #dcf8c6;
        border-radius: 12px 12px 0 12px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.2);
    }

    .chat-name {
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 3px;
        color: #374151;
    }

    .chat-time {
        font-size: 11px;
        color: #6b7280;
        margin-top: 4px;
        text-align: right;
    }

    /* Reply Box (bottom form) */
    .reply-box {
        background: #ffffff;
        border-radius: 16px;
        padding: 14px 16px;
        margin-top: 14px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.08);
        border: 1px solid #e5e7eb;
    }

</style>

<div class="ticket-wrapper">

    {{-- HEADER --}}
    <h3 class="fw-bold mb-3">Ticket #{{ $ticket->id }}</h3>

    {{-- TICKET INFO CARD --}}
    <div class="ticket-box mb-3">

        <h5 class="fw-bold mb-1">{{ $ticket->subject }}</h5>
        <p class="mb-2">{{ $ticket->description }}</p>

        <div class="ticket-meta d-flex flex-wrap justify-content-between">
            <small>
                <strong>User:</strong> {{ $ticket->user->name }} <br>
                <strong>Priority:</strong> {{ $ticket->priority }}
            </small>

            <small>
                <strong>Status:</strong> {{ $ticket->status }} <br>
                <strong>Created:</strong> {{ $ticket->created_at->format('d M Y, H:i') }}
            </small>
        </div>

        {{-- STATUS UPDATE --}}
        <form method="POST" action="{{ route('agent.tickets.status',$ticket->id) }}"
              class="mt-3 d-flex gap-2">
            @csrf

            <select name="status" class="form-select w-auto">
                <option {{ $ticket->status=="New"?'selected':'' }}>New</option>
                <option {{ $ticket->status=="In Progress"?'selected':'' }}>In Progress</option>
                <option {{ $ticket->status=="Resolved"?'selected':'' }}>Resolved</option>
                <option {{ $ticket->status=="Closed"?'selected':'' }}>Closed</option>
            </select>

            <button class="btn btn-primary btn-sm px-3">Update Status</button>
        </form>

    </div>


    {{-- CHAT SECTION --}}
    <h5 class="fw-bold mb-2">Conversation</h5>

    <div class="chat-container" id="chatContainer">
        <div class="chat-list">

            {{-- First message as ticket description (optional) --}}
            <div class="chat-msg from-user">
                <div class="chat-name">{{ $ticket->user->name }} (Ticket Created)</div>
                <div>{{ $ticket->description }}</div>
                <div class="chat-time">{{ $ticket->created_at->diffForHumans() }}</div>
            </div>

            {{-- Replies --}}
            @foreach($ticket->replies as $reply)
                <div class="chat-msg {{ $reply->user->role=='agent' ? 'from-agent' : 'from-user' }}">
                    <div class="chat-name">
                        {{ $reply->user->name }}
                        @if($reply->user->role=='agent')
                            <span class="text-muted" style="font-size:11px;">(Agent)</span>
                        @endif
                    </div>

                    <div>{{ $reply->content }}</div>

                    <div class="chat-time">
                        {{ $reply->created_at->diffForHumans() }}
                    </div>
                </div>
            @endforeach

        </div>
    </div>


    {{-- REPLY BOX --}}
    <h5 class="fw-bold mt-4">Reply</h5>

    <div class="reply-box">
        <form method="POST" action="{{ route('agent.tickets.reply',$ticket->id) }}">
            @csrf
            <textarea name="content" rows="2" class="form-control mb-2"
                      placeholder="Type your reply..." required></textarea>

            <div class="d-flex justify-content-end">
                <button class="btn btn-success px-4">
                    Send Reply
                </button>
            </div>
        </form>
    </div>

</div>

@endsection

@section('scripts')
<script>
    // Auto-scroll chat to bottom on load
    const chatContainer = document.getElementById('chatContainer');
    if (chatContainer) {
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }
</script>
@endsection
