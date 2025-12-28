<?php

namespace App\Models\Rekordbox;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string|null $ID
 * @property int|null $Seq
 * @property string|null $Name
 * @property int|null $Attribute
 * @property string|null $ParentID
 * @property string|null $DateCreated
 * @property string|null $UUID
 * @property int|null $rb_data_status
 * @property int|null $rb_local_data_status
 * @property int|null $rb_local_deleted
 * @property int|null $rb_local_synced
 * @property int|null $usn
 * @property int|null $rb_local_usn
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read Collection<int, \App\Models\Rekordbox\RekordboxSongHistory> $rekordboxSongHistories
 * @property-read int|null $rekordbox_song_histories_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxHistory whereAttribute($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxHistory whereDateCreated($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxHistory whereID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxHistory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxHistory whereParentID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxHistory whereRbDataStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxHistory whereRbLocalDataStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxHistory whereRbLocalDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxHistory whereRbLocalSynced($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxHistory whereRbLocalUsn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxHistory whereSeq($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxHistory whereUUID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxHistory whereUsn($value)
 * @mixin \Eloquent
 */
class RekordboxHistory extends RekordboxModel
{
    protected $table = 'djmdHistory';

    public function rekordboxSongHistories(): HasMany
    {
        return $this->hasMany(RekordboxSongHistory::class, 'HistoryID', 'ID');
    }
}
