<?php

use App\Models\Article;
use App\Models\Category;
use App\Models\Language;
use App\Models\Menu;
use Analytics as GoogleAnalytics;

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
    function getCategories()
    {
        $categories = [];
        $parentCategories = Category::parent()->get();
        foreach ($parentCategories as $parentCategory) {
            foreach ($parentCategory->children as $child) {
                $categories[] = [
                    'id' => $child->id,
                    'name' => $child->name,
                ];
            }
        }
        return $categories;
    }
}

if (!function_exists('getMainMenus')) {
    function getMainMenus()
    {
        $menus = Menu::orderBy('order', 'ASC')->byType('main-menu')
            ->active()
            ->parent()
            ->get();

        $result = [];

        foreach ($menus as $menu) {
            $menuArray = [
                'label'         => $menu->name,
                'id'            => $menu->id,
                'value'         => $menu->id,
                'description'   => $menu->description,
                'link'          => $menu->link ?? "#",
                'active'        => isActiveMenu($menu),
                'children'      => []
            ];

            if ($menu->activeChildren) {
                foreach ($menu->activeChildren as $child) {
                    $childArray = [
                        'label'         => $child->name,
                        'id'            => $child->id,
                        'value'         => $child->id,
                        'description'   => $child->description,
                        'link'          => $child->link ?? "#",
                        'children'      => getChildMenu($child),
                    ];

                    $menuArray['children'][] = $childArray;
                }
            }

            $result[] = $menuArray;
        }

        return collect($result);
    }
}
if (!function_exists('getChildMenu')) {
    function getChildMenu($menu)
    {
        $subMenus = [];
        if ($menu->activeChildren) {
            foreach ($menu->activeChildren as $child) {
                $subMenus[] = [
                    'label'         => $child->name,
                    'id'            => $child->id,
                    'value'         => $child->id,
                    'description'   => $child->description,
                    'children'      => getChildMenu($child),
                    'link'          => $child->link ?? "javascript:void(0)"
                ];
            }
        }
        return collect($subMenus);
    }
}

if (!function_exists('getLatestNews')) {
    function getLatestNews()
    {
        return Article::byArticleSlug('news-and-events')
            ->active()
            ->orderByDesc('updated_at')
            ->first();
    }
}

if (!function_exists('isActiveMenu')) {
    function isActiveMenu($menu)
    {
        $slug = request('slug');
        $article = Article::where('slug', $slug)->first();

        if ($article && $article->menu) {
            $articleMenu = $article->menu;
            $topParent = $articleMenu->getTopParent($articleMenu);

            if ($articleMenu->id === $menu->id || $menu->id === $topParent) {
                return 'active';
            }
        }

        return false;
    }
}

if (!function_exists('totalVisitor')) {
    function totalVisitor($period)
    {
        $analyticsData = GoogleAnalytics::performQuery(
            $period,
            'ga:sessions',
            [
                'metrics' => 'ga:sessions, ga:pageviews',
                'dimensions' => 'ga:yearMonth'
            ]
        );

        $totalSessions = $analyticsData?->totalsForAllResults['ga:sessions'] ?? 0;

        return number_format($totalSessions);
    }
}
