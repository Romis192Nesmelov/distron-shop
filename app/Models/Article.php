<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use Sluggable;
    use HasFactory;

    protected $fillable = [
        'image',
        'slug',
        'name',
        'short_text',
        'text',
        'seo_id',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function seo(): BelongsTo
    {
        return $this->belongsTo(Seo::class);
    }
}
