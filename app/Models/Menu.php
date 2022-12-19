<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class Menu extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = [
        'category_id',
        'type',
        'article_id',
        'parent_id',
        'slug',
        'icon',
        'status',
        'order',
        'type',
        'created_by',
        'updated_by'
    ];
    use SoftDeletes;
    function content()
    {
        $lang = Language::byLocale(App::getLocale())->first();
        return $this->hasOne(MenuContent::class, 'menu_id', 'id')->where('lang_id', $lang->id ?? null);
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
        $content = $this->hasOne(MenuContent::class, 'menu_id', 'id')->whereNotNull('name')->first();
        $name = $content->name ?? "";
        return $name;
    }
    function getDescriptionAttribute()
    {
        $content = $this->content;
        if ($content) {
            if ($content->description !== "") {
                return $content->description ?? "";
            }
        }
        $content = $this->hasOne(MenuContent::class, 'menu_id', 'id')->whereNotNull('description')->first();
        return $content->description ?? "";
    }
    public function scopeByType($query, $menuType)
    {
        return $query->where('type', $menuType);
    }
    function scopeParent($query)
    {
        return $query->whereNull('parent_id')->orWhere('parent_id', 0);
    }
    function parentCategories()
    {
        $parentCategories = Menu::parent()->get();
        return $parentCategories;
    }
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id')->with('children')->orderBy('order', 'ASC');
    }
}
