<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'parent_id',
        'slug',
        'icon',
        'status',
        'type',
        'is_new'
    ];
    use SoftDeletes;
    function content()
    {
        $lang = Language::byLocale(App::getLocale())->first();
        return $this->hasOne(CategoryContent::class, 'category_id', 'id')->where('lang_id', $lang->id ?? null);
    }
    function getNameAttribute()
    {
        $content = $this->content;
        $name = "";
        if ($content) {
            if ($content->name !== "") {
                return $content->name ?? "";
            }
        }
        $content = $this->hasOne(CategoryContent::class, 'category_id', 'id')
            ->whereNotNull('name')
            ->where('name', '<>', '')
            ->first();
        return $content->name ?? "";
    }
    function getDescriptionAttribute()
    {
        $content = $this->content;
        if ($content) {
            if ($content->description !== "") {
                return $content->description ?? "";
            }
        }
        $content = $this->hasOne(CategoryContent::class, 'category_id', 'id')
            ->whereNotNull('description')
            ->where('description', '<>', '')
            ->first();
        return $content->description ?? "";
    }
    function scopeParent($query)
    {
        return $query->whereNull('parent_id')->orWhere('parent_id', 0);
    }
    function parentCategories()
    {
        $parentCategories = Category::parent()->get();
        return $parentCategories;
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->with('children');
    }
    public function categoryContents()
    {
        return $this->hasMany(CategoryContent::class, 'category_id', 'id');
    }
    public function scopeBySlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }
}
