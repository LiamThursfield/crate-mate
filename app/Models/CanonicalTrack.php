<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $title
 * @property numeric|null $bpm
 * @property int $duration
 * @property string|null $key
 * @property int|null $canonical_artist_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $verified_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CanonicalArtist|null $canonicalArtist
 * @property-read Collection<int, \App\Models\LibraryTrack> $libraryTracks
 * @property-read int|null $library_tracks_count
 * @property-read \App\Models\User|null $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CanonicalTrack newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CanonicalTrack newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CanonicalTrack query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CanonicalTrack whereBpm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CanonicalTrack whereCanonicalArtistId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CanonicalTrack whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CanonicalTrack whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CanonicalTrack whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CanonicalTrack whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CanonicalTrack whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CanonicalTrack whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CanonicalTrack whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CanonicalTrack whereVerifiedAt($value)
 *
 * @mixin \Eloquent
 */
class CanonicalTrack extends Model
{
    use HasFactory;

    protected $fillable = [
        'bpm',
        'canonical_artist_id',
        'duration',
        'key',
        'title',
        'user_id',
        'verified_at',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function libraryTracks(): HasMany
    {
        return $this->hasMany(LibraryTrack::class, 'canonical_track_id', 'id');
    }

    public function canonicalArtist(): HasOne
    {
        return $this->hasOne(CanonicalArtist::class, 'id', 'canonical_artist_id');
    }
}
