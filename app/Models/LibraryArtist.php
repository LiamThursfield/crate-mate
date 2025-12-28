<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property int $canonical_artist_id
 * @property string $name
 * @property int $library_id
 * @property string $source_artist_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CanonicalArtist|null $canonicalArtist
 * @property-read \App\Models\Library|null $library
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LibraryTrack> $libraryTracks
 * @property-read int|null $library_tracks_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryArtist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryArtist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryArtist query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryArtist whereCanonicalArtistId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryArtist whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryArtist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryArtist whereLibraryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryArtist whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryArtist whereSourceArtistId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryArtist whereUpdatedAt($value)
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
