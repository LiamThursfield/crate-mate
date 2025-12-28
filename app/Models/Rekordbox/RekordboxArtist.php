<?php

namespace App\Models\Rekordbox;

/**
 * @property string|null $ID
 * @property string|null $Name
 * @property string|null $SearchStr
 * @property string|null $UUID
 * @property int|null $rb_data_status
 * @property int|null $rb_local_data_status
 * @property int|null $rb_local_deleted
 * @property int|null $rb_local_synced
 * @property int|null $usn
 * @property int|null $rb_local_usn
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxArtist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxArtist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxArtist query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxArtist whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxArtist whereID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxArtist whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxArtist whereRbDataStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxArtist whereRbLocalDataStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxArtist whereRbLocalDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxArtist whereRbLocalSynced($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxArtist whereRbLocalUsn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxArtist whereSearchStr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxArtist whereUUID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxArtist whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxArtist whereUsn($value)
 * @mixin \Eloquent
 */
class RekordboxArtist extends RekordboxModel
{
    protected $table = 'djmdArtist';
}
