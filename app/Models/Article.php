<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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
    protected $appends = ['name', 'description', 'category_name', 'created_on'];
    use SoftDeletes;
    public function content()
    {
        $lang = Language::byLocale(App::getLocale())->first();
        return $this->hasOne(ArticleContent::class, 'article_id', 'id')->where('lang_id', $lang->id ?? null);
    }
    public function getNameAttribute()
    {
        $content = $this->content ?? "";
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
    public function getDescriptionAttribute()
    {
        $content = $this->content ?? "";
        if ($content) {
            if ($content->desc !== "") {
                return $content->desc ?? "";
            }
        }
        $content = $this->hasOne(ArticleContent::class, 'article_id', 'id')->whereNotNull('desc')->first();
        return $content->desc ?? "";
    }
    public function getCategoryNameAttribute()
    {
        return $this->category?->name ?? "";
    }
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    public function getCreatedOnAttribute()
    {
        return $this->created_at->format('d, Y M h:i:s a');
    }
    public function scopeByCategory($query, $categoryId)
    {
        $query->where('category_id', $categoryId);
    }
}
