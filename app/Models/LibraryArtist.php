<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $canonical_artist_id
 * @property string $name
 * @property int $library_id
 * @property string $source_artist_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read CanonicalArtist $canonicalArtist
 * @property-read Library $library
 * @property-read Collection<int, LibraryTrack> $libraryTracks
 * @property-read int|null $library_tracks_count
 *
 * @method static Builder<static>|LibraryArtist newModelQuery()
 * @method static Builder<static>|LibraryArtist newQuery()
 * @method static Builder<static>|LibraryArtist ofUser(\App\Models\User $user)
 * @method static Builder<static>|LibraryArtist query()
 * @method static Builder<static>|LibraryArtist whereCanonicalArtistId($value)
 * @method static Builder<static>|LibraryArtist whereCreatedAt($value)
 * @method static Builder<static>|LibraryArtist whereId($value)
 * @method static Builder<static>|LibraryArtist whereLibraryId($value)
 * @method static Builder<static>|LibraryArtist whereName($value)
 * @method static Builder<static>|LibraryArtist whereSourceArtistId($value)
 * @method static Builder<static>|LibraryArtist whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class LibraryArtist extends Model
{
    protected $fillable = [
        'canonical_artist_id',
        'library_id',
        'name',
        'source_artist_id',
    ];

    public function canonicalArtist(): BelongsTo
    {
        return $this->belongsTo(CanonicalArtist::class);
    }

    public function library(): BelongsTo
    {
        return $this->belongsTo(Library::class);
    }

    public function libraryTracks(): HasMany
    {
        return $this->hasMany(LibraryTrack::class);
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
