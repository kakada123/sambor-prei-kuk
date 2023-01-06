<?php

use App\Models\Article;
use App\Models\Category;
use App\Models\Language;
use App\Models\Menu;
// use Analytics as GoogleAnalytics;
use Spatie\Analytics\AnalyticsFacade as Analytics;

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
                'link'          => $menu->link ?? "#",
                'active'        => activeMenu($menu)
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

if (!function_exists('activeMenu')) {
    function activeMenu($theMenu)
    {
        $slug = Request('slug');
        $article = Article::bySlug($slug)->first();
        if ($article) {
            $menu = Menu::where('article_id', $article->id)->first();
            if ($menu) {
                if ($menu->id === $theMenu->id ?? null) {
                    return 'active';
                } else {
                    $topParent = $menu->getTopParent($menu);
                    if ($theMenu->id === $topParent) {
                        return 'active';
                    }
                }
            }
        }
        return false;
    }
}

if (!function_exists('totalVisitor')) {
    function totalVisitor($period)
    {
        $analyticsData = Analytics::performQuery(
            $period,
            'ga:sessions',
            [
                'metrics' => 'ga:sessions, ga:pageviews',
                'dimensions' => 'ga:yearMonth'
            ]
        );
        return number_format($analyticsData?->totalsForAllResults['ga:sessions'] ?? 0);
    }
}
