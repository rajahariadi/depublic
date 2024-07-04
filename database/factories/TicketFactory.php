<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $event = Event::inRandomOrder()->first();

        return [
            'event_id' => $event,
            'type' => fake()->text(10),
            'price' => fake()->numberBetween(10000, 100000),
        ];
    }
}
