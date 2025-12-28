<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $name
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $verified_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LibraryArtist> $libraryArtists
 * @property-read int|null $library_artists_count
 * @property-read \App\Models\User|null $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CanonicalArtist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CanonicalArtist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CanonicalArtist query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CanonicalArtist whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CanonicalArtist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CanonicalArtist whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CanonicalArtist whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CanonicalArtist whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CanonicalArtist whereVerifiedAt($value)
 *
 * @mixin \Eloquent
 */
class CanonicalArtist extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'verified_at',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    public function isVerified(): bool
    {
        return $this->verified_at !== null;
    }

    public function isNotVerified(): bool
    {
        return ! $this->isVerified();
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function libraryArtists(): HasMany
    {
        return $this->hasMany(LibraryArtist::class, 'canonical_artist_id', 'id');
    }
}
