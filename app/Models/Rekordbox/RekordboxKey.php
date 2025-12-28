<?php

namespace App\Models\Rekordbox;

/**
 * @property string|null $ID
 * @property string|null $ScaleName
 * @property int|null $Seq
 * @property string|null $UUID
 * @property int|null $rb_data_status
 * @property int|null $rb_local_data_status
 * @property int|null $rb_local_deleted
 * @property int|null $rb_local_synced
 * @property int|null $usn
 * @property int|null $rb_local_usn
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxKey newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxKey newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxKey query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxKey whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxKey whereID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxKey whereRbDataStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxKey whereRbLocalDataStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxKey whereRbLocalDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxKey whereRbLocalSynced($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxKey whereRbLocalUsn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxKey whereScaleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxKey whereSeq($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxKey whereUUID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxKey whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxKey whereUsn($value)
 * @mixin \Eloquent
 */
class RekordboxKey extends RekordboxModel
{
    protected $table = 'djmdKey';
}
