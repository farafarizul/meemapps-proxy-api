<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EndpointConfig extends Model
{
    protected $fillable = [
        'key', 'upstream_url', 'http_method', 'headers_json', 'options_json', 'is_active',
    ];

    protected $casts = [
        'headers_json' => 'array',
        'options_json' => 'array',
        'is_active' => 'boolean',
    ];
}
