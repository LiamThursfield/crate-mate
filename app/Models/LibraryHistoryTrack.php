<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $library_history_id
 * @property int $library_track_id
 * @property int $track_no
 * @property \Illuminate\Support\Carbon $date
 * @property int $library_id
 * @property string $source_history_track_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryHistoryTrack newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryHistoryTrack newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryHistoryTrack query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryHistoryTrack whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryHistoryTrack whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryHistoryTrack whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryHistoryTrack whereLibraryHistoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryHistoryTrack whereLibraryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryHistoryTrack whereLibraryTrackId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryHistoryTrack whereSourceHistoryTrackId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryHistoryTrack whereTrackNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryHistoryTrack whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class LibraryHistoryTrack extends Model
{
    use HasFactory;

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
