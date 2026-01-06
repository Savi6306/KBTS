<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Category;
use App\Models\TicketLog;
use App\Notifications\TicketUpdated;
use Illuminate\Http\Request;

class AdminTicketController extends Controller
{
    // ================================
    // LIST + FILTER TICKETS
    // ================================
    public function index(Request $request)
    {
        $query = Ticket::with(['user', 'agent', 'category']);

        // Search
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($x) use ($q) {
                $x->where('subject', 'like', "%$q%")
                  ->orWhereHas('user', function ($u) use ($q) {
                      $u->where('name', 'like', "%$q%")
                        ->orWhere('email', 'like', "%$q%");
                  });
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Priority filter
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Date range
        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        // Agent filter
        if ($request->filled('agent')) {
            $query->where('agent_id', $request->agent);
        }

        $tickets = $query->latest()->paginate(10)->appends($request->query());

        $categories = Category::select('id', 'name')->get();
        $agents     = User::where('role', 'agent')->select('id', 'name')->get();

        return view('admin.tickets.index', compact('tickets', 'categories', 'agents'));
    }

    // ================================
    // SHOW TICKET
    // ================================
    public function show(Ticket $ticket)
    {
        $ticket->load([
            'user',
            'agent',
            'category',
            'replies.user',
            'replies.attachments',
            'logs'
        ]);

        $agents = User::where('role', 'agent')->get();

        return view('admin.tickets.show', compact('ticket','agents'));
    }

    // ================================
    // UPDATE STATUS + LOG + EMAIL
    // ================================
    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status'       => 'required|in:New,In Progress,Resolved,Closed',
            'close_reason' => 'nullable|string|max:255',
        ]);

        $oldStatus = $ticket->status;
        $ticket->status = $request->status;

        if ($request->status === 'Closed') {
            $ticket->close_reason = $request->close_reason;
        }

        $ticket->save();

        // LOG
        TicketLog::create([
            'ticket_id' => $ticket->id,
            'action'    => "Status changed from $oldStatus to {$request->status}",
            'done_by'   => auth()->id()
        ]);

        // Send email safely
        if ($ticket->user) {
            $ticket->user->notify(
                new TicketUpdated($ticket, "The status of your ticket has changed from $oldStatus to {$request->status}.")
            );
        }

        return back()->with('success', 'Status updated successfully');
    }

    // ================================
    // ASSIGN AGENT + LOG + EMAIL
    // ================================
    public function assignAgent(Request $request, Ticket $ticket)
    {
        $request->validate([
            'agent_id' => 'nullable|exists:users,id'
        ]);

        $previous = $ticket->agent_id;

        $ticket->agent_id = $request->agent_id;
        $ticket->save();

        TicketLog::create([
            'ticket_id' => $ticket->id,
            'action'    => "Agent changed from ".($previous ?: 'None')." to ".($request->agent_id ?: 'None'),
            'done_by'   => auth()->id()
        ]);

        // Email to user
        if ($ticket->user) {
            $ticket->user->notify(
                new TicketUpdated($ticket, "Your ticket has been assigned to an agent.")
            );
        }

        // Email to agent
        if ($ticket->agent) {
            $ticket->agent->notify(
                new TicketUpdated($ticket, "A new ticket has been assigned to you.")
            );
        }

        return back()->with('success', 'Agent assigned successfully');
    }

    // ================================
    // ADMIN REPLY + ATTACHMENT
    // ================================
    public function reply(Request $request, Ticket $ticket)
    {
        $request->validate([
            'content'    => 'required|string',
            'attachment' => 'nullable|file|max:5120',
        ]);

        $reply = $ticket->replies()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $path = $file->store('attachments', 'public');

            $reply->attachments()->create([
                'file_path'     => $path,
                'original_name' => $file->getClientOriginalName(),
                'mime_type'     => $file->getClientMimeType(),
                'file_size'     => $file->getSize(),
            ]);
        }

        TicketLog::create([
            'ticket_id' => $ticket->id,
            'action'    => "Reply added by admin",
            'done_by'   => auth()->id()
        ]);

        // Notify user
        if ($ticket->user) {
            $ticket->user->notify(
                new TicketUpdated($ticket, "An admin has replied to your ticket.")
            );
        }

        return back()->with('success', 'Reply added successfully!');
    }

    // ================================
    // DELETE TICKET
    // ================================
    public function destroy(Ticket $ticket)
    {
        TicketLog::create([
            'ticket_id' => $ticket->id,
            'action'    => "Ticket deleted",
            'done_by'   => auth()->id()
        ]);

        $ticket->delete();

        return back()->with('success', 'Ticket deleted');
    }
}
