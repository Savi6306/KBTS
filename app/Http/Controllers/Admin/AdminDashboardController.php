<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use App\Models\KbArticle;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // ---- BASIC STATS ----
        $totalTickets    = Ticket::count();
        $openTickets     = Ticket::whereIn('status',['New','In Progress'])->count();
        $resolvedTickets = Ticket::where('status','Resolved')->count();
        $users           = User::where('role','user')->count();
        $agents          = User::where('role','agent')->count();
        $totalArticles   = KbArticle::count();
// ⭐ NEW: HIGH PRIORITY OPEN TICKETS
        $highPriorityOpen = Ticket::whereIn('status', ['New', 'In Progress'])
                                  ->where('priority', 'High')
                                  ->count();
        $recentTickets = Ticket::with('user')
                            ->latest()
                            ->take(5)
                            ->get();

        // ---- MONTHLY TICKET CHART (LAST 6 MONTHS) ----
        $monthly = Ticket::select(
                        DB::raw('DATE_FORMAT(created_at, "%b") as month_label'),
                        DB::raw('COUNT(*) as total')
                    )
                    ->groupBy('month_label')
                    ->orderByRaw('MIN(created_at)')
                    ->limit(6)
                    ->get();

        $months       = $monthly->pluck('month_label')->toArray();
        $ticketCounts = $monthly->pluck('total')->toArray();

        // Fallback (empty chart fix)
        if (empty($months)) {
            $months       = ['Jan','Feb','Mar','Apr','May','Jun'];
            $ticketCounts = [0,0,0,0,0,0];
        }

        // ---- PRIORITY SPLIT (PIE CHART) ----
        $priorityRaw = Ticket::select('priority', DB::raw('COUNT(*) as total'))
                        ->groupBy('priority')
                        ->get();

        $priorityLabels = $priorityRaw->pluck('priority')->toArray();
        $priorityData   = $priorityRaw->pluck('total')->toArray();

        if (empty($priorityLabels)) {
            $priorityLabels = ['Low','High'];
            $priorityData   = [0,0];
        }

        return view('admin.dashboard', compact(
            'totalTickets',
            'openTickets',
            'resolvedTickets',
            'users',
            'agents',
            'totalArticles',
            'recentTickets',
            'months',
            'ticketCounts',
            'priorityLabels',
            'priorityData',
             'highPriorityOpen'   // ✅ yahan add kiya
        ));
    }
}
