<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorporateAction extends Model
{
    protected $fillable = ['date', 'category', 'title', 'summary', 'content', 'link_url'];
}
