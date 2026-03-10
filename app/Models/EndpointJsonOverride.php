<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EndpointJsonOverride extends Model
{
    protected $fillable = [
        'endpoint_key', 'merge_strategy', 'override_json', 'is_active',
    ];

    protected $casts = [
        'override_json' => 'array',
        'is_active' => 'boolean',
    ];
}
