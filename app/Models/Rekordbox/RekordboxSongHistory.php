<?php

namespace App\Models\Rekordbox;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string|null $ID
 * @property string|null $HistoryID
 * @property string|null $ContentID
 * @property int|null $TrackNo
 * @property string|null $UUID
 * @property int|null $rb_data_status
 * @property int|null $rb_local_data_status
 * @property int|null $rb_local_deleted
 * @property int|null $rb_local_synced
 * @property int|null $usn
 * @property int|null $rb_local_usn
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\Rekordbox\RekordboxHistory|null $rekordboxHistory
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxSongHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxSongHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxSongHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxSongHistory whereContentID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxSongHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxSongHistory whereHistoryID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxSongHistory whereID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxSongHistory whereRbDataStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxSongHistory whereRbLocalDataStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxSongHistory whereRbLocalDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxSongHistory whereRbLocalSynced($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxSongHistory whereRbLocalUsn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxSongHistory whereTrackNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxSongHistory whereUUID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxSongHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxSongHistory whereUsn($value)
 *
 * @mixin \Eloquent
 */
class RekordboxSongHistory extends RekordboxModel
{
    protected $table = 'djmdSongHistory';

    public function rekordboxHistory(): BelongsTo
    {
        return $this->belongsTo(RekordboxHistory::class, 'ID', 'HistoryID');
    }
}
