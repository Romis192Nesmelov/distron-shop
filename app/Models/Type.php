<?php

namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    use Sluggable;

    protected $fillable = [
        'image',
        'slug',
        'name',
        'singular',
        'text',
        'is_service'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
