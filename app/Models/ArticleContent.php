<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleContent extends Model
{
    use HasFactory;
    protected $fillable = [
        'article_id',
        'lang_id',
        'name',
        'desc',
        'created_by'
    ];
}
