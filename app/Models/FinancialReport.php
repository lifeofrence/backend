<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialReport extends Model
{
    protected $fillable = ['period', 'type', 'title', 'subtitle', 'file_path', 'is_active'];
}
