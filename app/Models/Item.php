<?php

namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;

class Item extends Model
{
    use Sluggable;

    protected $fillable = [
        'image',
        'slug',
        'name',
        'description',
        'price',
        'type_id',

        'capacity',
        'voltage',

        'section',
        'length',
        'width',
        'height',
        'rated_current',

        'technology_id',
        'plates',

        'description_file',
        'file',

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

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function technology(): BelongsTo
    {
        return $this->belongsTo(Technology::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)->withTimestamps()->withPivot(['value']);
    }

    public function seo(): BelongsTo
    {
        return $this->belongsTo(Seo::class);
    }

    public function scopeSearched(Builder $query): void
    {
        $searched = request('find');
        $technologyIds = Technology::query()->where('name', 'LIKE', "%{$searched}%")->pluck('id')->toArray();

        $query->when($searched, function (Builder $query) use ($searched, $technologyIds) {
            foreach (['name','description','capacity'] as $name) {
                $query = $query->where($name, 'LIKE', "%{$searched}%");
            }
            $query->orWhereIn('id', $technologyIds);
        });
    }

    public function scopeFiltered(Builder $query): void
    {
        $query->when(request('min_price') && request('max_price'), function (Builder $q) {
            $q->whereBetween('price',[request('min_price'),request('max_price')]);
        });

        $query->when(request('min_voltage') && request('max_voltage'), function (Builder $q) {
            $q->whereBetween('voltage',[request('min_voltage'),request('max_voltage')]);
        });

        $query->when(request('min_capacity') && request('max_capacity'), function (Builder $q) {
            $q->whereBetween('capacity',[request('min_capacity'),request('max_capacity')]);
        });

        $query->when(request('min_plates') && request('max_plates'), function (Builder $q) {
            $q->whereBetween('plates',[request('min_plates'),request('max_plates')]);
        });

        $query->when(request('min_length') && request('max_length'), function (Builder $q) {
            $q->whereBetween('length',[request('min_length'),request('max_length')]);
        });

        $query->when(request('min_width') && request('max_width'), function (Builder $q) {
            $q->whereBetween('width',[request('min_width'),request('max_width')]);
        });

        $query->when(request('min_height') && request('max_height'), function (Builder $q) {
            $q->whereBetween('height',[request('min_height'),request('max_height')]);
        });

        $query->when(request('min_section') && request('max_section'), function (Builder $q) {
            $q->whereBetween('section',[request('min_section'),request('max_section')]);
        });
    }
}
