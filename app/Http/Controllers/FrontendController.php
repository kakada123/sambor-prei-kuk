<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Analytics;
use Spatie\Analytics\Period;

class FrontendController extends Controller
{
    /**
     * Homepage
     * @return var 
     * $underSliders, 
     * $leftArticles
     * $rightArticles
     * $newsAndEvents
     */
    public function index()
    {
        $underSliders = Article::byArticleSlug('under-slider-articles')
            ->homeArticles();
        $leftArticles = Article::byArticleSlug('left-articles')
            ->homeArticles();
        $rightArticles = Article::byArticleSlug('right-articles')
            ->homeArticles();
        $newsAndEvents =  Article::byArticleSlug('news-and-events')
            ->orderBy('order', 'ASC')
            ->take(4)
            ->active()
            ->orderBy('created_at', 'DESC')->paginate(6);
        $banners = Article::byArticleSlug('banners')->homeArticles();
        return view('frontend/index', compact(
            'underSliders',
            'leftArticles',
            'rightArticles',
            'newsAndEvents',
            'banners'
        ));
    }
    /**
     * Artcile Detail
     * @param mixed $slug
     */
    public function articleDetail($slug)
    {
        $articleDetail = Article::bySlug($slug)
            ->active()
            ->first();
        if ($articleDetail) {
            $relatedArticles = Article::byArticleSlug($articleDetail?->category?->slug ?? "")
                ->active()
                ->orderBy('created_at', 'DESC')
                ->whereNotIn('id', [$articleDetail->id ?? 0])
                ->paginate(12);
            //Process 
            $leftMenuCategory = Category::bySlug('structure-of-sambor-prei-kuk-national-authority')->first();
            $leftMenus =
                Menu::byType('left-menu')
                ->orderBy('id', 'ASC')->get();
            $leftArticlesDetail =
                Article::byArticleSlug('left-articles-details')
                ->homeArticles();
            return view('frontend/article/detail', compact(
                'articleDetail',
                'relatedArticles',
                'leftMenus',
                'leftArticlesDetail',
                'leftMenuCategory'
            ));
        }
        abort(404);
    }
}
