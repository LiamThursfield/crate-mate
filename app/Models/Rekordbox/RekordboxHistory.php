<?php

namespace App\Models\Rekordbox;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read string $ID
 * @property-read string $Name
 * @property-read int $Attribute
 * @property-read string $DateCreated
 * @property-read Collection<RekordboxSongHistory> $rekordboxSongHistories
 */
class RekordboxHistory extends RekordboxModel
{
    protected $table = 'djmdHistory';

    public function rekordboxSongHistories(): HasMany
    {
        return $this->hasMany(RekordboxSongHistory::class, 'HistoryID', 'ID');
    }
}
