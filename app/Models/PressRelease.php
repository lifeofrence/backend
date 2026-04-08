<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PressRelease extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'date',
        'content',
        'is_active',
    ];
}
