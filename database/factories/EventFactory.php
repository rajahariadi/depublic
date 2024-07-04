<?php

namespace Database\Factories;

use App\Models\EventCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $name = fake()->text(25);
        $event_category = EventCategory::inRandomOrder()->first();

        // Menghasilkan highlight dengan beberapa baris teks
        $highlights = fake()->sentences(5); // Menghasilkan array dengan 3 kalimat
        $highlight = implode("\n", $highlights); // Menggabungkan kalimat-kalimat dengan line break

        // Menghasilkan start_event antara bulan Juni hingga Desember tahun ini
        $start_event = fake()->dateTimeBetween('first day of June this year', 'last day of December this year');
        // Menghasilkan end_event yang selalu setelah start_event
        $end_event = fake()->dateTimeBetween($start_event->format('Y-m-d H:i:s'), $start_event->format('Y-m-d H:i:s') . ' +1 week');



        return [
            'name' => $name,
            'event_category_id' => $event_category->id,
            'description' => fake()->text(255),
            'location' => fake()->text(10),
            'image' => fake()->imageUrl(640, 640),
            'slug' => Str::slug($name),
            'highlight' => $highlight,
            'start_event' => $start_event,
            'end_event' => $end_event
        ];
    }
}
