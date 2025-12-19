<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property int $library_history_id
 * @property int $library_track_id
 * @property int $track_no
 * @property Carbon $date
 * @property int $library_id
 * @property string $source_history_track_id
 */
class LibraryHistoryTrack extends Model
{
    protected $casts = [
        'date' => 'datetime',
    ];

    protected $fillable = [
        'date',
        'library_history_id',
        'library_id',
        'library_track_id',
        'source_history_track_id',
        'track_no',
    ];
}
