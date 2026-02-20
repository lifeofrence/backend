<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadershipMember extends Model
{
    protected $fillable = ['name', 'title', 'bio', 'image_path', 'type', 'order_index'];
}
