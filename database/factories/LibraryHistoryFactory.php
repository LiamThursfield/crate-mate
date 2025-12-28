<?php

namespace Database\Factories;

use App\Models\Library;
use App\Models\LibraryHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LibraryHistory>
 */
class LibraryHistoryFactory extends Factory
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
            'date' => $this->faker->dateTimeThisYear(),
            'include_in_stats' => true,
            'library_id' => Library::factory(),
            'source_history_id' => $this->faker->uuid(),
        ];
    }
}
