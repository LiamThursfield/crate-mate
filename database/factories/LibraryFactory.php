<?php

namespace Database\Factories;

use App\Enums\LibrarySource;
use App\Models\Library;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Library>
 */
class LibraryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'source' => $this->faker->randomElement(LibrarySource::cases()),
            'user_id' => User::factory(),
        ];
    }
}
