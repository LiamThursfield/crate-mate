<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property int|null $canonical_track_id
 * @property string $title
 * @property numeric|null $bpm
 * @property int $duration
 * @property string|null $key
 * @property int|null $library_artist_id
 * @property int $library_id
 * @property string $source_track_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CanonicalTrack|null $canonicalTrack
 * @property-read \App\Models\Library|null $library
 * @property-read \App\Models\LibraryArtist|null $libraryArtist
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryTrack newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryTrack newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryTrack query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryTrack whereBpm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryTrack whereCanonicalTrackId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryTrack whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryTrack whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryTrack whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryTrack whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryTrack whereLibraryArtistId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryTrack whereLibraryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryTrack whereSourceTrackId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryTrack whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryTrack whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class LibraryTrack extends Model
{
    protected $fillable = [
        'bpm',
        'canonical_track_id',
        'duration',
        'key',
        'library_artist_id',
        'library_id',
        'source_track_id',
        'title',
    ];

    public function canonicalTrack(): BelongsTo
    {
        return $this->belongsTo(CanonicalTrack::class, 'id', 'canonical_track_id');
    }

    public function library(): HasOne
    {
        return $this->hasOne(Library::class);
    }

    public function libraryArtist(): BelongsTo
    {
        return $this->belongsTo(LibraryArtist::class, 'id', 'library_artist_id');
    }
}
