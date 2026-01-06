<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Support\Facades\Auth;

class AgentDashboardController extends Controller
{
    public function index()
    {
        $agentId = Auth::id();

        // Basic Stats
        $totalAssigned   = Ticket::where('agent_id',$agentId)->count();
        $pendingTickets  = Ticket::where('agent_id',$agentId)
                                ->whereIn('status',['New','In Progress'])
                                ->count();
        $resolvedTickets = Ticket::where('agent_id',$agentId)
                                ->where('status','Resolved')
                                ->count();

        // Today's stats
        $todayNew      = Ticket::where('agent_id',$agentId)
                            ->whereDate('created_at', today())
                            ->count();

        $todayResolved = Ticket::where('agent_id',$agentId)
                            ->where('status','Resolved')
                            ->whereDate('updated_at', today())
                            ->count();

        $todayReplies  = TicketReply::where('user_id',$agentId)
                            ->whereDate('created_at', today())
                            ->count();

        // Priority Pie (Low / High)
        $priorityLabels = ['Low','High'];
        $priorityData = [
            Ticket::where('agent_id',$agentId)->where('priority','Low')->count(),
            Ticket::where('agent_id',$agentId)->where('priority','High')->count(),
        ];

        // Status Bar Chart
        $statusLabels = ['New','In Progress','Resolved','Closed'];
        $statusData = [
            Ticket::where('agent_id',$agentId)->where('status','New')->count(),
            Ticket::where('agent_id',$agentId)->where('status','In Progress')->count(),
            Ticket::where('agent_id',$agentId)->where('status','Resolved')->count(),
            Ticket::where('agent_id',$agentId)->where('status','Closed')->count(),
        ];

        // Weekly chart (last 7 days tickets created)
        $weekLabels = [];
        $weekData   = [];

        foreach (range(6,0) as $i) {
            $date = now()->subDays($i);
            $weekLabels[] = $date->format('D');
            $weekData[]   = Ticket::where('agent_id',$agentId)
                                ->whereDate('created_at', $date->toDateString())
                                ->count();
        }

        // Recent tickets & replies
        $recentTickets = Ticket::where('agent_id',$agentId)
                            ->latest()
                            ->take(5)
                            ->get();

        $recentReplies = TicketReply::whereIn(
                                'ticket_id',
                                Ticket::where('agent_id',$agentId)->pluck('id')
                            )
                            ->latest()
                            ->take(5)
                            ->get();

        return view('agent.dashboard', compact(
            'totalAssigned',
            'pendingTickets',
            'resolvedTickets',
            'todayNew',
            'todayResolved',
            'todayReplies',
            'priorityLabels',
            'priorityData',
            'statusLabels',
            'statusData',
            'weekLabels',
            'weekData',
            'recentTickets',
            'recentReplies'
        ));
    }
}
