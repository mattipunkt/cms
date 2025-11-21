<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Location;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Showtime>
 */
class ShowtimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'time' => $this->faker->dateTimeBetween('+1 day', '+14 day'), // Ein zufälliger Zeitpunkt innerhalb des nächsten Monats
            'location_id' => Location::inRandomOrder()->first()->id, // Eine zufällige Location-ID aus der Location-Tabelle
            'event_id' => Event::inRandomOrder()->first()->id, // Eine zufällige Event-ID aus der Event-Tabelle
            'movie_id' => Movie::inRandomOrder()->first()->id, // Eine zufällige Movie-ID aus der Movie-Tabelle
            'language' => $this->faker->randomElement(['Synchro', 'OV', 'OmU']), // Zufällige Sprache (de, en, fr, es)
        ];
    }
}
