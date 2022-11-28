<?php

use App\Models\Category;
use App\Models\Language;

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
        // dd($categories);
    }
}
