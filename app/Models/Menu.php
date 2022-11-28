<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = [
        'category_id',
        'parent_id',
        'slug',
        'icon',
        'status',
        'type'
    ];
}
