<?php

namespace App\Models;

use App\Enums\LibrarySource;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 * @property int $canonical_track_id
 * @property string $title
 * @property float $bpm
 * @property int $duration
 * @property string $key
 * @property ?int $library_artist_id
 * @property int $user_id
 * @property LibrarySource $source
 * @property string $source_track_id
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read ?LibraryArtist $libraryArtist
 */
class LibraryTrack extends Model
{
    protected $fillable = [
        'bpm',
        'canonical_track_id',
        'duration',
        'key',
        'library_artist_id',
        'source',
        'source_track_id',
        'title',
        'user_id',
    ];

    protected $casts = [
        'source' => LibrarySource::class,
    ];

    public function libraryArtist(): BelongsTo
    {
        return $this->belongsTo(LibraryArtist::class, 'id', 'library_artist_id');
    }
}
