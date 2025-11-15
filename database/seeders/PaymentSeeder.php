<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Payment;
class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Booking::all()->each(function ($booking) {
            // Only create payment if the booking has a ticket
            if ($booking->ticket) {
                Payment::factory()->create([
                    'booking_id' => $booking->id,
                    'amount' => $booking->ticket->price, // Use ticket price
                ]);
            }
        });
    }
}
