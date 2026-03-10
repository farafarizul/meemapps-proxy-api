<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    protected $fillable = [
        'slug', 'title', 'subtitle', 'hero_text', 'content_json', 'is_published',
    ];

    protected $casts = [
        'content_json' => 'array',
        'is_published' => 'boolean',
    ];

    public function sections(): HasMany
    {
        return $this->hasMany(PageSection::class)->orderBy('sort_order');
    }
}
