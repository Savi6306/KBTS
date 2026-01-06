<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject',
        'description',
        'status',
        'priority',
        
        'agent_id',
        'category_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(TicketReply::class);
    }
    public function agent()
{
    return $this->belongsTo(User::class, 'agent_id');
}
public function category()
{
    return $this->belongsTo(\App\Models\Category::class, 'category_id');
}

public function logs() {
    return $this->hasMany(TicketLog::class);
}

}