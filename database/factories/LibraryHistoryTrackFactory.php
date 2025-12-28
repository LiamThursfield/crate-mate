<?php

namespace Database\Factories;

use App\Models\Library;
use App\Models\LibraryHistory;
use App\Models\LibraryHistoryTrack;
use App\Models\LibraryTrack;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LibraryHistoryTrack>
 */
class LibraryHistoryTrackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'library_history_id' => LibraryHistory::factory(),
            'library_track_id' => LibraryTrack::factory(),
            'track_no' => $this->faker->numberBetween(1, 100),
            'date' => $this->faker->dateTimeThisYear(),
            'library_id' => Library::factory(),
            'source_history_track_id' => $this->faker->uuid(),
        ];
    }
}
