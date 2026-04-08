<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeyMaterial extends Model
{
    protected $fillable = [
        'title',
        'category',
        'date',
        'file_path',
        'is_active',
    ];
}
