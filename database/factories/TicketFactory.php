<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;   // <-- Add this
use App\Models\Ticket;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['VIP', 'Standard', 'Economy']),
            'price' => $this->faker->randomFloat(2, 10, 500),
            'quantity' => $this->faker->numberBetween(10, 100),
            'event_id' => Event::factory(), // now PHP knows where Event is
        ];
    }
}