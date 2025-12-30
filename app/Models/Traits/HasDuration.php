<?php

namespace App\Models\Traits;

/**
 * @property int $duration
 */
trait HasDuration
{
    /**
     * Get the duration formatted as minutes and seconds (e.g., "3:45").
     */
    public function getDurationAsMinutesAndSeconds(): string
    {
        $minutes = floor($this->duration / 60);
        $seconds = $this->duration % 60;

        return sprintf('%d:%02d', $minutes, $seconds);
    }
}
