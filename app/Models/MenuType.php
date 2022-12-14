<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_en',
        'name_km',
        'slug'
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
