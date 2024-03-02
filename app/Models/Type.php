<?php

namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'is_service',
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

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function seo(): BelongsTo
    {
        return $this->belongsTo(Seo::class);
    }

    public function scopeSearched(Builder $query): void
    {
        $searched = request('find');
        $query->when($searched, function (Builder $q) use ($searched) {
            $q
                ->where('name', 'LIKE', "%{$searched}%")
                ->orWhere('text', 'LIKE', "%{$searched}%");
        });
    }
}
