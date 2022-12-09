<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'thumbnail',
        'status',
        'slug',
        'created_by',
    ];
    protected $appends = ['name', 'description', 'category_name'];
    function content()
    {
        $lang = Language::byLocale(App::getLocale())->first();
        return $this->hasOne(ArticleContent::class, 'article_id', 'id')->where('lang_id', $lang->id ?? null);
    }
    function getNameAttribute()
    {
        $content = $this->content;
        $name = "";
        if ($content) {
            if ($content->name !== "") {
                $name = $content->name ?? "";
            }
        }
        $content = $this->hasOne(ArticleContent::class, 'article_id', 'id')->whereNotNull('name')->first();
        $name = $content->name ?? "";
        return $name;
    }
    function getDescriptionAttribute()
    {
        $content = $this->content;
        if ($content) {
            if ($content->desc !== "") {
                return $content->desc ?? "";
            }
        }
        $content = $this->hasOne(ArticleContent::class, 'article_id', 'id')->whereNotNull('desc')->first();
        return $content->desc ?? "";
    }
    function getCategoryNameAttribute()
    {
        return $this->category->name;
    }
    function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
