<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Action extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'alt_img',
        'name',
        'text',
        'active',
        'seo_id',
    ];

    public function seo(): BelongsTo
    {
        return $this->belongsTo(Seo::class);
    }
}
