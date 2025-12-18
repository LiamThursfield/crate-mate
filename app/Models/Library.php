<?php

namespace App\Models;

use App\Enums\LibrarySource;
use Carbon\Carbon;
use Database\Factories\LibraryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * @property-read int $id
 * @property string $name
 * @property LibrarySource $source
 * @property int $user_id
 * @property Carbon $deleted_at
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read User $user
 * @property-read Collection<LibraryArtist> $artists
 * @property-read Collection<LibraryTrack> $tracks
 */
class Library extends Model
{
    /** @use HasFactory<LibraryFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'source',
        'user_id',
    ];

    protected $casts = [
        'source' => LibrarySource::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function artists(): HasMany
    {
        return $this->hasMany(LibraryArtist::class);
    }

    public function tracks(): HasMany
    {
        return $this->hasMany(LibraryTrack::class);
    }
}
