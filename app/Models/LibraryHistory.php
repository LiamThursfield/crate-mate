<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property string $name
 * @property Carbon $date
 * @property bool $include_in_stats
 * @property int $library_id
 * @property string $source_history_id
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
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
