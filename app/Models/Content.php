<?php

namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Content extends Model
{
    use Sluggable;

    protected $fillable = [
        'slug',
        'head',
        'text',
        'seo_id',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'head'
            ]
        ];
    }

    public function seo(): BelongsTo
    {
        return $this->belongsTo(Seo::class);
    }
}
