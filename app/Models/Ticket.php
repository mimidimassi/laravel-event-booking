<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- correct import

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
      use HasFactory;

    protected $fillable = [
        'type',
        'price',
        'quantity',
        'event_id',
    ];

    // Relationship with Event table ticket is belong to event 
    public function event()
    {
        return $this->belongsTo(Event::class);
    }


    // Ticket has many bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
