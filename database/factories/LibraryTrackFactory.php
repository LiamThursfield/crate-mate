<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LibraryTrack>
 */
class LibraryTrackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'bpm' => $this->faker->randomFloat(1, 120, 130),
            'duration' => $this->faker->numberBetween(180, 420),
            'key' => $this->faker->randomElement(['1A', '2A', '3A', '4A', '5A', '6A', '7A', '8A', '9A', '10A', '11A', '12A']),
            'library_id' => \App\Models\Library::factory(),
            'library_artist_id' => \App\Models\LibraryArtist::factory(),
            'source_track_id' => $this->faker->uuid(),
            'canonical_track_id' => null,
        ];
    }
}
