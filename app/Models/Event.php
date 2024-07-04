<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at'];

    public function eventCategory()
    {
        return $this->belongsTo(EventCategory::class);
    }

    public function ticket()
    {
        return $this->hasMany(Ticket::class);
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
