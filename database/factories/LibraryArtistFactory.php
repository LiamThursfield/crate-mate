<?php

namespace Database\Factories;

use App\Models\CanonicalArtist;
use App\Models\Library;
use App\Models\LibraryArtist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LibraryArtist>
 */
class LibraryArtistFactory extends Factory
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
            'source_artist_id' => $this->faker->uuid(),
            'library_id' => Library::factory(),
            'canonical_artist_id' => CanonicalArtist::factory(),
        ];
    }
}
