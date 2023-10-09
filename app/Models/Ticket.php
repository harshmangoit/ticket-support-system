<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'detail',
        'status',
        'priority',
        'category_id',
        'user_id',
        'agent_id',
        'awaiting_from',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(TicketImage::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class);
    }
}
