<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

// Notifications
use App\Notifications\TicketCreatedNotification;
use App\Notifications\TicketRepliedNotification;

class UserTicketController extends Controller
{
    // -------------------------
    // SHOW ALL USER TICKETS
    // -------------------------
    public function index()
    {
        $tickets = Ticket::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.tickets.index', compact('tickets'));
    }

    // -------------------------
    // CREATE TICKET FORM
    // -------------------------
    public function create()
    {
        $categories = Category::all();
        return view('user.tickets.create', compact('categories'));
    }

    // -------------------------
    // STORE NEW TICKET (SAFE)
    // -------------------------
    public function store(Request $request)
    {
        // ✅ Validation
        $data = $request->validate([
            'subject'     => 'required|string|max:255',
            'description' => 'required|string',
            'priority'    => 'required|in:Low,Medium,High,Critical',
            'category_id' => 'required|exists:categories,id',
        ]);

        // ✅ Ticket Create
        $ticket = Ticket::create([
            'user_id'     => Auth::id(),
            'subject'     => $data['subject'],
            'description' => $data['description'],
            'priority'    => $data['priority'],
            'category_id' => $data['category_id'],
            'status'      => 'New',
        ]);

        // ✅ SAFE NOTIFICATION (Mailtrap error se protect)
        try {
            $admins = User::where('role', 'admin')->get();

            foreach ($admins as $admin) {
                $admin->notify(new TicketCreatedNotification($ticket));
            }
        } catch (\Exception $e) {
            Log::error('Ticket Created Mail Error: ' . $e->getMessage());
            // Email fail ho jaye tab bhi ticket & redirect kaam kare
        }

        return redirect()
            ->route('user.tickets.show', $ticket->id)
            ->with('success', 'Ticket created successfully!');
    }

    // -------------------------
    // SHOW SINGLE TICKET
    // -------------------------
    public function show(Ticket $ticket)
    {
        $this->authorizeTicket($ticket);

        $ticket->load([
            'replies.user',
            'replies.attachments',
            'category'
        ]);

        return view('user.tickets.show', compact('ticket'));
    }

    // -------------------------
    // ADD REPLY + ATTACHMENT
    // -------------------------
    public function reply(Request $request, Ticket $ticket)
    {
        $this->authorizeTicket($ticket);

        $request->validate([
            'content'    => 'required|string',
            'attachment' => 'nullable|file|max:5120',
        ]);

        // ✅ Save Reply
        $reply = $ticket->replies()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        // ✅ Attachment Upload
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

        // ✅ SAFE NOTIFICATIONS
        try {
            // Notify Admins
            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                $admin->notify(new TicketRepliedNotification($ticket, $reply));
            }

            // Notify Agent (if assigned)
            if ($ticket->agent_id) {
                $agent = User::find($ticket->agent_id);
                if ($agent) {
                    $agent->notify(new TicketRepliedNotification($ticket, $reply));
                }
            }
        } catch (\Exception $e) {
            Log::error('Ticket Reply Mail Error: ' . $e->getMessage());
        }

        return back()->with('success', 'Reply added successfully!');
    }

    // -------------------------
    // AUTH CHECK
    // -------------------------
    private function authorizeTicket(Ticket $ticket)
    {
        if ($ticket->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access');
        }
    }
}
