<?php

namespace App\Models\Rekordbox;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read string $ID
 * @property-read string $HistoryID
 * @property-read string $ContentID
 * @property-read int $TrackNo
 * @property-read string $created_at
 * @property-read RekordboxHistory $rekordboxHistory
 */
class RekordboxSongHistory extends RekordboxModel
{
    protected $table = 'djmdSongHistory';

    public function rekordboxHistory(): BelongsTo
    {
        return $this->belongsTo(RekordboxHistory::class, 'ID', 'HistoryID');
    }
}
