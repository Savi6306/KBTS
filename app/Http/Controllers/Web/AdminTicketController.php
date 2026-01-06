<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\TicketRepliedNotification;

class AdminTicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::query()->with('user','agent');

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }
        if ($priority = $request->get('priority')) {
            $query->where('priority', $priority);
        }

        $tickets = $query->latest()->paginate(15);

        return view('admin.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        $ticket->load('user','agent','replies.user');
        $agents = User::whereIn('role',['agent','admin'])->get();

        return view('admin.tickets.show', compact('ticket','agents'));
    }

    public function reply(Request $request, Ticket $ticket)
    {
        $data = $request->validate([
            'content' => 'required|string',
            'status' => 'nullable|in:New,In Progress,Resolved',
        ]);

        $reply = TicketReply::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
            'content' => $data['content'],
        ]);

        if (!empty($data['status'])) {
            $ticket->status = $data['status'];
            $ticket->save();
        }

        // notify ticket owner
        $ticket->user->notify(new TicketRepliedNotification($ticket, $reply));

        return back()->with('success','Reply added.');
    }

    public function assign(Request $request, Ticket $ticket)
    {
        $data = $request->validate([
            'assigned_to' => 'required|exists:users,id',
        ]);

        $ticket->assigned_to = $data['assigned_to'];
        $ticket->save();

        return back()->with('success','Ticket assigned.');
    }
}
