<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuContent extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'menu_id',
        'lang_id',
        'name',
        'description'
    ];
}
