<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $films = config('films');
        $name = array_rand($films, 1);
        $film = $films[$name];

        // También se puede utilizar fake() en vez de $this->faker
        return [
            'name' => $film['name'],
            'genre' => $film['genre'],
            'duration' => $film['duration'],
            'director' => $film['director'],
            'description' => $film['description'],
        ];
    }
}
