<?php

namespace App\Models\Rekordbox;

use App\Models\LibraryArtist;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property-read string $ID
 * @property-read ?string $ArtistID
 * @property-read ?int $BPM
 * @property-read ?int $KeyID
 * @property-read ?int $Length
 * @property-read ?string $Title
 * @property-read ?RekordboxKey $rekordboxKey
 * @property-read LibraryArtist $libraryArtist
 */
class RekordboxTrack extends RekordboxModel
{
    protected $table = 'djmdContent';

    public function rekordboxKey(): HasOne
    {
        return $this->hasOne(RekordboxKey::class, 'ID', 'KeyID');
    }
}
