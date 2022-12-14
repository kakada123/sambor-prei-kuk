<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = [
        'category_id',
        'parent_id',
        'slug',
        'icon',
        'status',
        'type'
    ];
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
        return $this->hasMany(Menu::class, 'parent_id', 'id')->with('children');
    }
}
