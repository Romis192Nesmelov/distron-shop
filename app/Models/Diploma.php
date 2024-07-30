<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diploma extends Model
{
    protected $fillable = [
        'image',
        'alt_img',
        'active'
    ];
}
