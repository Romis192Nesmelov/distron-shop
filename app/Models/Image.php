<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    protected $fillable = ['preview','full', 'content_id'];

    public $timestamps = false;

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }
}
