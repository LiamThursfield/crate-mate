<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

/**
 * @property-read int $id
 * @property int $canonical_artist_id
 * @property string $name
 * @property int $library_id
 * @property string $source_artist_id
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read CanonicalArtist $canonicalArtist
 * @property-read Library $library
 * @property-read Collection<LibraryTrack> $libraryTracks
 */
class LibraryArtist extends Model
{
    protected $fillable = [
        'canonical_artist_id',
        'library_id',
        'name',
        'source_artist_id',
    ];

    public function canonicalArtist(): HasOne
    {
        return $this->hasOne(CanonicalArtist::class, 'id', 'canonical_artist_id');
    }

    public function library(): HasOne
    {
        return $this->hasOne(Library::class);
    }

    public function libraryTracks(): HasMany
    {
        return $this->hasMany(LibraryTrack::class, 'library_artist_id', 'id');
    }
}
