<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property-read int $id
 * @property string $title
 * @property float $bpm
 * @property int $duration
 * @property string $key
 * @property ?int $canonical_artist_id
 * @property int $user_id
 * @property Carbon $verified_at
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read User $user
 * @property-read Collection<LibraryTrack> $libraryTracks
 * @property-read ?CanonicalArtist $canonicalArtist
 */
class CanonicalTrack extends Model
{
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
