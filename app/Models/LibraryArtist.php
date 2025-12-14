<?php

namespace App\Models;

use App\Enums\LibrarySource;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

/**
 * @property-read int $id
 * @property int $canonical_artist_id
 * @property string $name
 * @property int $user_id
 * @property LibrarySource $source
 * @property string $source_artist_id
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read User $user
 * @property-read CanonicalArtist $canonicalArtist
 * @property-read Collection<LibraryTrack> $libraryTracks
 */
class LibraryArtist extends Model
{
    protected $fillable = [
        'canonical_artist_id',
        'name',
        'source',
        'source_artist_id',
        'user_id',
    ];

    protected $casts = [
        'source' => LibrarySource::class,
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function canonicalArtist(): BelongsTo
    {
        return $this->belongsTo(CanonicalArtist::class, 'id', 'canonical_artist_id');
    }

    public function libraryTracks(): HasMany
    {
        return $this->hasMany(LibraryTrack::class, 'library_artist_id', 'id');
    }
}
