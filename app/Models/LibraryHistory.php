<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon $date
 * @property bool $include_in_stats
 * @property int $library_id
 * @property string $source_history_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryHistory whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryHistory whereIncludeInStats($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryHistory whereLibraryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryHistory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryHistory whereSourceHistoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LibraryHistory whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class LibraryHistory extends Model
{
    protected $casts = [
        'date' => 'datetime',
        'include_in_stats' => 'boolean',
    ];

    protected $fillable = [
        'name',
        'date',
        'include_in_stats',
        'library_id',
        'source_history_id',
    ];
}
