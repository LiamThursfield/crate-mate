<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

/**
 * @property-read int $id
 * @property string $name
 * @property int $user_id
 * @property Carbon $verified_at
 * @property-read Carbon $created_at
 * @property Carbon $updated_at
 * @property-read User $user
 * @property-read Collection<LibraryArtist> $libraryArtists
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

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function libraryArtists(): HasMany
    {
        return $this->hasMany(LibraryArtist::class, 'canonical_artist_id', 'id');
    }
}
