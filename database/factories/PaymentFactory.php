<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   protected $model = \App\Models\Payment::class;

    public function definition(): array
    {
        return [
            'booking_id' => Booking::factory(), // Payment belongs to Booking
            'amount' => $this->faker->randomFloat(2, 10, 500), // amount between 10 and 500
            'status' => $this->faker->randomElement(['success', 'failed', 'refunded']),
        ];
    }
}
