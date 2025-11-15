<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\Ticket;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Ticket::all()->each(function ($ticket) {
            // Random users booking this ticket
            User::inRandomOrder()->take(2)->each(function ($user) use ($ticket) {
                Booking::factory()->create([
                    'user_id' => $user->id,
                    'ticket_id' => $ticket->id,
                ]);
            });
        });
    }
}
