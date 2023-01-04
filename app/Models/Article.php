<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
    protected $appends = ['name', 'description', 'category_name', 'created_on', 'thumbnail_src'];
    use SoftDeletes;
    public function content()
    {
        $lang = Language::byLocale(App::getLocale())->first();
        return $this->hasOne(ArticleContent::class, 'article_id', 'id')->where('lang_id', $lang->id ?? null);
    }
    public function getNameAttribute()
    {
        $content = $this->content ?? "";
        if ($content) {
            if ($content->name !== "") {
                return $content->name ?? "";
            }
        }
        $content = $this->hasOne(ArticleContent::class, 'article_id', 'id')
            ->whereNotNull('name')
            ->where('name', '<>', '')
            ->first();
        return  $content->name ?? "";
    }
    public function getDescriptionAttribute()
    {
        $content = $this->content ?? "";
        if ($content) {
            if ($content->desc !== "") {
                return $content->desc ?? "";
            }
        }
        $content = $this->hasOne(ArticleContent::class, 'article_id', 'id')
            ->whereNotNull('desc')
            ->where('desc', '<>', '')
            ->first();
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
    public function getThumbnailSrcAttribute()
    {
        if (Storage::disk('public')->exists($this->thumbnail ?? "") && $this->thumbnail !== null) {
            return asset(Storage::url($this->thumbnail));
        }
        return asset("/assets/image/no-image.jpg");
    }
    public function scopeByArticleSlug($query, $slug)
    {
        $categoryId = Category::bySlug($slug)->pluck('id');
        return $query->where('category_id', $categoryId ?? null);
    }
    public function getShortDescriptionAttribute()
    {
        return strip_tags($this->description ?? "");
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function scopeHomeArticles($query)
    {
        return $query->orderBy('order', 'ASC')
            ->take(4)
            ->active()
            ->get();
    }
    public function scopeBySlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }
    public function getFullDescriptionAttribute()
    {
        return Str::replace('../../storage/', asset('/storage') . '/', $this->description ?? "");
    }
    public function getCreatedAtFormatAttribute()
    {
        return
            Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at ?? now())->format('l, M Y h:i A');
    }
    public function getLinkAttribute()
    {
        if ($this->full_description) {
            return route('article_detail', $this->slug ?? "");
        }
        return "javascript:void(0)";
    }
}
