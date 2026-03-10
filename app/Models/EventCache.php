<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventCache extends Model
{
    protected $fillable = [
        'event_date', 'explanation', 'source', 'is_valid',
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_valid' => 'boolean',
    ];
}
