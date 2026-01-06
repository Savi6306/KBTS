<?php

namespace App\Console\Commands;

use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Console\Command;

class EscalateTicketPriority extends Command
{
    /**
     * Use command:
     * php artisan tickets:escalate
     */
    protected $signature = 'tickets:escalate';

    protected $description = 'Escalate priority of tickets not updated for 7 days';

    public function handle(): int
    {
        $cutoff = Carbon::now()->subDays(7);

        // Fetch all eligible tickets
        $tickets = Ticket::whereIn('status', ['New', 'In Progress'])
            ->where('priority', 'Low')
            ->where('updated_at', '<=', $cutoff)
            ->get();

        $count = 0;

        foreach ($tickets as $ticket) {

            // Update priority
            $ticket->priority = 'High';
            $ticket->save();

            $count++;

            // Optional future (notify admin/agent/user)
            // $ticket->user->notify(new TicketUpdated(...));
        }

        $this->info("Escalated {$count} ticket(s) to High priority.");

        return Command::SUCCESS;
    }
}
