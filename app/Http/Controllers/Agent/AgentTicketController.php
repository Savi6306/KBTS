<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Notifications\TicketRepliedNotification;

class AgentTicketController extends Controller
{
    // =======================
    // ALL TICKETS ASSIGNED TO AGENT
    // =======================
    public function index(Request $request)
    {
        $query = Ticket::with(['category', 'user'])
            ->where('agent_id', Auth::id());

        // 🔍 Search
        if ($request->filled('search')) {
            $query->where('subject', 'like', '%' . $request->search . '%');
        }

        // 📌 Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 🚩 Priority
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        // 📅 DATE FILTER (WORKING)
        if ($request->filled('from') && $request->filled('to')) {
            $from = Carbon::createFromFormat('Y-m-d', $request->from)->startOfDay();
            $to   = Carbon::createFromFormat('Y-m-d', $request->to)->endOfDay();

            $query->whereBetween('created_at', [$from, $to]);
        }

        // ✅ Pagination (filters preserved)
        $tickets = $query->latest()
                         ->paginate(10)
                         ->withQueryString();

        $statuses = ['New', 'In Progress', 'Resolved', 'Closed'];

        return view('agent.tickets.index', compact('tickets', 'statuses'));
    }

    // =======================
    // SHOW TICKET DETAILS
    // =======================
    public function show(Ticket $ticket)
    {
        if ($ticket->agent_id !== Auth::id()) {
            abort(403);
        }

        $ticket->load(['replies.user', 'user', 'category']);

        return view('agent.tickets.show', compact('ticket'));
    }

    // =======================
    // AGENT REPLY + USER NOTIFICATION
    // =======================
    public function reply(Request $request, Ticket $ticket)
    {
        if ($ticket->agent_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'content' => 'required|string',
        ]);

        $reply = TicketReply::create([
            'ticket_id' => $ticket->id,
            'user_id'   => Auth::id(),
            'content'   => $request->content,
        ]);

        if ($ticket->status === 'New') {
            $ticket->update(['status' => 'In Progress']);
        }

        // Notify user
        if ($ticket->user) {
            $ticket->user->notify(
                new TicketRepliedNotification($ticket, $reply)
            );
        }

        return back()->with('success', 'Reply added and user notified.');
    }

    // =======================
    // CHANGE STATUS
    // =======================
    public function changeStatus(Request $request, Ticket $ticket)
    {
        if ($ticket->agent_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:New,In Progress,Resolved,Closed',
        ]);

        $ticket->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status updated.');
    }
}
