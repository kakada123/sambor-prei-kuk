<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        $todayVisitor =  totalVisitor(Period::days(1));
        $sixMonths = totalVisitor(Period::months(6));
        $yesterDay = totalVisitor(Period::create(Carbon::yesterday(), Carbon::yesterday()));
        $online = totalVisitor(Period::create(Carbon::now(), Carbon::now()));
        return view('frontend/index', compact(
            'underSliders',
            'leftArticles',
            'rightArticles',
            'newsAndEvents',
            'banners',
            'todayVisitor',
            'sixMonths',
            'yesterDay',
            'online'
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
            $todayVisitor =  totalVisitor(Period::days(1));
            $sixMonths = totalVisitor(Period::months(6));
            $yesterDay = totalVisitor(Period::create(Carbon::yesterday(), Carbon::yesterday()));
            $online = totalVisitor(Period::create(Carbon::now(), Carbon::now()));
            return view('frontend/article/detail', compact(
                'articleDetail',
                'relatedArticles',
                'leftMenus',
                'leftArticlesDetail',
                'leftMenuCategory',
                'todayVisitor',
                'sixMonths',
                'yesterDay',
                'online'
            ));
        }
        abort(404);
    }
}
