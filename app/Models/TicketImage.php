<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'ticket_id',
        'image',
    ];
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
