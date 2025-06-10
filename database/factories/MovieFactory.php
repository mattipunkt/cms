<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'  => $this->faker->words(3, true),
            'year'   => $this->faker->year(),
            'country' => $this->faker->country(),
            'runtime' => $this->faker->randomFloat(2, 1, 5),
            'trailer_url' => $this->faker->url(),
            'image' => $this->faker->url(),
            'director' => $this->faker->name(),
            'actors' => $this->faker->name(),
            'genre' =>  $this->faker->word(),
            'description' => $this->faker->text(),


        ];
    }
}
