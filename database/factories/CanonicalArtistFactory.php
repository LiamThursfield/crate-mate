<?php

namespace Database\Factories;

use App\Models\CanonicalArtist;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CanonicalArtist>
 */
class CanonicalArtistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'user_id' => User::factory(),
            'verified_at' => $this->faker->boolean() ? $this->faker->dateTimeThisYear() : null,
        ];
    }
}
