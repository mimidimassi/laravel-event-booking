<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;    // l
use App\Models\Ticket; 
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Booking::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),    // Booking belongs to a User
            'ticket_id' => Ticket::factory(), // Booking belongs to a Ticket
        ];
    }
}
