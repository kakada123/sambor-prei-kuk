<?php

use App\Models\Article;
use App\Models\Category;
use App\Models\Language;
use App\Models\Menu;

if (!function_exists('langs')) {
    function langs()
    {
        $langs = Language::select('name', 'id', 'locale')->orderBy('id', 'DESC')->get();
        if ($langs) {
            return $langs;
        }
        return [];
    }
}
if (!function_exists('categories')) {
    function categories()
    {
        $categories = [];
        $parentsCategories = Category::parent()->get();
        foreach ($parentsCategories as $parentCategory) {
            $childs = $parentCategory->children;
            foreach ($childs as $childs) {
                $categories[] = [
                    'id'    => $parentCategory->id,
                    'name' => $parentCategory->name,
                ];
            }
        }
    }
}

if (!function_exists('mainMenus')) {
    function mainMenus()
    {
        $menus = Menu::orderBy('order', 'ASC')->byType('main-menu')
            ->active()
            ->parent()
            ->get();
        $theMenus = [];
        foreach ($menus as $menu) {
            $theMenus[$menu->id] = [
                'label'         => $menu->name,
                'id'            => $menu->id,
                'value'         => $menu->id,
                'description'   => $menu->description,
                'link'          => $menu->link ?? "#"
            ];
            if ($menu->activeChildren) {
                foreach ($menu->activeChildren as $child) {
                    $theMenus[$menu->id]['children'][] = [
                        'label'         => $child->name,
                        'id'            => $child->id,
                        'value'         => $child->id,
                        'description'   => $child->description,
                        'children'      => childMenu($child),
                        'link'          => $child->link ?? "#"
                    ];
                }
            }
        }
        return collect(array_values($theMenus));
    }
}
if (!function_exists('childMenu')) {
    function childMenu($menu)
    {
        $subMenus = [];
        if ($menu->activeChildren) {
            foreach ($menu->activeChildren as $child) {
                $subMenus[] = [
                    'label'         => $child->name,
                    'id'            => $child->id,
                    'value'         => $child->id,
                    'description'   => $child->description,
                    'children'      => childMenu($child),
                    'link'          => $child->link ?? "javascript:void(0)"
                ];
                collect(childMenu($child));
            }
            return collect(array_values($subMenus));
        }
    }
}

if (!function_exists('latestNews')) {
    function latestNews()
    {
        return Article::byArticleSlug('news-and-events')->orderBy('created_at', 'DESC')->active()->first();
    }
}
