<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\map;

class Language extends Model
{
    use HasFactory;
    public function scopeByLocale($query, $locale){
        return $query->where('locale', $locale);
    }
}
