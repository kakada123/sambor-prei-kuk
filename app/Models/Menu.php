<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use PhpParser\Node\Stmt\Catch_;

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
        if ($content) {
            if ($content->name !== "") {
                return $content->name ?? "";
            }
        }
        $content = $this->hasOne(MenuContent::class, 'menu_id', 'id')
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
        $content = $this->hasOne(MenuContent::class, 'menu_id', 'id')
            ->whereNotNull('description')
            ->where('description', '<>', '')
            ->first();
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
    function parentMenus()
    {
        $parentMenus = Menu::parent()->get();
        return $parentMenus;
    }
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id')->with('children')->orderBy('order', 'ASC');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function activeChildren()
    {
        return $this->children()->active();
    }
    public function getLinkAttribute()
    {
        if ($this->isCategoryMenu()) {
            return "category/" . $this->category?->slug ?? "javascript:void(0);";
        }

        if ($this->isArticleMenu()) {
            return $this->article?->link ?? "javascript:void(0);";
        }
        return "javascript:void(0);";
    }
    public function isCategoryMenu()
    {
        if ($this->category && $this->isArticleMenu() === false) {
            return true;
        }
        return false;
    }
    public function isArticleMenu()
    {
        if ($this->article) {
            return true;
        }
        return false;
    }
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    public function article()
    {
        return $this->hasOne(Article::class, 'id', 'article_id');
    }
    public function parentMenu()
    {
        return $this->hasOne(Menu::class, 'parent_id', 'id');
    }
    public function parent()
    {
        return $this->hasOne(Menu::class, 'parent_id', 'id');
    }
    public function getTopParent($menu)
    {
        if ($menu->parent_id == null) {
            return $menu->id;
        }

        $parent = Menu::find($menu->parent_id);

        return $this->getTopParent($parent);
    }
}
