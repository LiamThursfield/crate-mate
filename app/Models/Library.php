<?php

namespace App\Models;

use App\Enums\LibrarySource;
use Database\Factories\LibraryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property LibrarySource $source
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LibraryArtist> $artists
 * @property-read int|null $artists_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LibraryHistory> $histories
 * @property-read int|null $histories_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LibraryHistoryTrack> $historyTracks
 * @property-read int|null $history_tracks_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LibraryTrack> $tracks
 * @property-read int|null $tracks_count
 * @property-read \App\Models\User $user
 *
 * @method static \Database\Factories\LibraryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Library newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Library newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Library onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Library query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Library whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Library whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Library whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Library whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Library whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Library whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Library whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Library withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Library withoutTrashed()
 *
 * @mixin \Eloquent
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

    public function histories(): HasMany
    {
        return $this->hasMany(LibraryHistory::class);
    }

    public function historyTracks(): HasMany
    {
        return $this->hasMany(LibraryHistoryTrack::class);
    }

    public function tracks(): HasMany
    {
        return $this->hasMany(LibraryTrack::class);
    }
}
