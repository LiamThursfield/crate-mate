<?php

namespace App\Models;

use App\Models\Traits\HasDuration;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
 * @property-read \App\Models\Library $library
 * @property-read \App\Models\LibraryArtist|null $libraryArtist
 *
 * @method static \Database\Factories\LibraryTrackFactory factory($count = null, $state = [])
 * @method static Builder<static>|LibraryTrack newModelQuery()
 * @method static Builder<static>|LibraryTrack newQuery()
 * @method static Builder<static>|LibraryTrack ofUser(\App\Models\User $user)
 * @method static Builder<static>|LibraryTrack query()
 * @method static Builder<static>|LibraryTrack whereBpm($value)
 * @method static Builder<static>|LibraryTrack whereCanonicalTrackId($value)
 * @method static Builder<static>|LibraryTrack whereCreatedAt($value)
 * @method static Builder<static>|LibraryTrack whereDuration($value)
 * @method static Builder<static>|LibraryTrack whereId($value)
 * @method static Builder<static>|LibraryTrack whereKey($value)
 * @method static Builder<static>|LibraryTrack whereLibraryArtistId($value)
 * @method static Builder<static>|LibraryTrack whereLibraryId($value)
 * @method static Builder<static>|LibraryTrack whereSourceTrackId($value)
 * @method static Builder<static>|LibraryTrack whereTitle($value)
 * @method static Builder<static>|LibraryTrack whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class LibraryTrack extends Model
{
    use HasDuration;
    use HasFactory;

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
        return $this->belongsTo(CanonicalTrack::class);
    }

    public function library(): BelongsTo
    {
        return $this->belongsTo(Library::class);
    }

    public function libraryArtist(): BelongsTo
    {
        return $this->belongsTo(LibraryArtist::class);
    }

    /**
     * Scope the query to only include artists from the given user's libraries.
     */
    public function scopeOfUser(Builder $query, User $user): void
    {
        $query->whereIn('library_id', function ($subquery) use ($user) {
            $subquery->select('id')
                ->from('libraries')
                ->where('user_id', $user->id);
        });
    }
}
