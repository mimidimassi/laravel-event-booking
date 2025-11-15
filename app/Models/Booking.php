<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'ticket_id'];

    // table booking is belong to table user
  
//every booking has one payment 
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
