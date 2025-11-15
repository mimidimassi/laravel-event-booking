<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
     use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'location',
        'created_by',
    ];

    // Relationship with user table event is belong to user 
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    //relation  with  ticket table each event has many ticket 
    public function tickets()
{
    return $this->hasMany(Ticket::class);
}
}
