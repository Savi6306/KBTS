<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketLog extends Model
{
    protected $fillable = [
        'ticket_id',
        'action',
        'done_by'
    ];

    // Who performed the action
    public function user() {
        return $this->belongsTo(User::class, 'done_by');
    }

    // Which ticket this log is for
    public function ticket() {
        return $this->belongsTo(Ticket::class);
    }
}
