<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;

        /* ================================
           1️⃣ DASHBOARD STATS
        ================================= */
        $totalTickets = Ticket::where('user_id', $userId)->count();

        $pendingTickets = Ticket::where('user_id', $userId)
                                ->whereIn('status', ['New', 'In Progress'])
                                ->count();

        $resolvedTickets = Ticket::where('user_id', $userId)
                                 ->where('status', 'Resolved')
                                 ->count();

        /* ================================
           2️⃣ RECENT 5 TICKETS
        ================================= */
        $recentTickets = Ticket::where('user_id', $userId)
                                ->latest()
                                ->take(5)
                                ->get();

        /* ================================
           3️⃣ RECENT REPLIES
        ================================= */
        $userTicketIds = Ticket::where('user_id', $userId)->pluck('id');

        $recentReplies = TicketReply::whereIn('ticket_id', $userTicketIds)
                                    ->latest()
                                    ->take(5)
                                    ->get();

        /* ================================
           4️⃣ GRAPH DATA (LAST 7 DAYS)
        ================================= */
        $days = collect(range(6, 0))->map(function ($i) {
            return now()->subDays($i)->format('d M');
        });

        $chartLabels = $days;

        $chartData = collect(range(6, 0))->map(function ($i) use ($userId) {
            return Ticket::where('user_id', $userId)
                ->whereDate('created_at', now()->subDays($i))
                ->count();
        });

        return view('user.dashboard', compact(
            'totalTickets',
            'pendingTickets',
            'resolvedTickets',
            'recentTickets',
            'recentReplies',
            'chartLabels',
            'chartData'
        ));
    }

}
