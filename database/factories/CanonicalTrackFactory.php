<?php

namespace Database\Factories;

use App\Models\CanonicalArtist;
use App\Models\CanonicalTrack;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CanonicalTrack>
 */
class CanonicalTrackFactory extends Factory
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
            'bpm' => $this->faker->randomFloat(2, 60, 190),
            'duration' => $this->faker->numberBetween(180, 420),
            'key' => $this->faker->randomElement(['1A', '2A', '3A']),
            'canonical_artist_id' => CanonicalArtist::factory(),
            'user_id' => User::factory(),
            'verified_at' => $this->faker->boolean() ? $this->faker->dateTimeBetween('-1 years', 'now') : null,
        ];
    }
}
