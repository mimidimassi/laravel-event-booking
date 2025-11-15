<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\Event;
class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Event::all()->each(function ($event) {
            // Each event has 3 tickets
            Ticket::factory(3)->create([
                'event_id' => $event->id,
            ]);
        });
    }
}
