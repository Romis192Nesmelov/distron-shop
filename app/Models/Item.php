<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;

class Item extends Model
{
    protected $fillable = [
        'image',
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
        'file'
    ];

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
    }
}
