<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
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
        $locale = App::getLocale();

        // Check if the articles data is already cached
        $articles = Article::whereHas('category', function ($query) use ($locale) {
            $query->whereIn('slug', ['under-slider-articles', 'left-articles', 'right-articles', 'banners']);
        })
            ->with('category')
            ->get()
            ->groupBy(function ($article) {
                return $article->category->slug;
            });

        // Check if the events data is already cached
        $events = Article::byArticleSlug('news-and-events')
            ->orderBy('order', 'ASC')
            ->take(4)
            ->active()
            ->orderBy('created_at', 'DESC')
            ->paginate(6);

        // Retrieve the specific article categories from the cached data
        $sliders = $articles['under-slider-articles'] ?? collect();
        $leftArticles = $articles['left-articles'] ?? collect();
        $rightArticles = $articles['right-articles'] ?? collect();
        $banners = $articles['banners'] ?? collect();


        // Get visitor statistics
        $todayVisitors = totalVisitor(Period::days(1));
        // Assuming you started tracking from January 1, 2010
        $startDate = Carbon::createFromDate(2010, 1, 1);
        // Set end date as today
        $endDate = Carbon::today();
        $sixMonthsVisitors =
            totalVisitor(Period::create($startDate, $endDate));
        $yesterdayVisitors = totalVisitor(Period::create(Carbon::yesterday(), Carbon::yesterday()));
        $onlineVisitors = totalVisitor(Period::create(Carbon::now(), Carbon::now()));

        return view('frontend/index', compact(
            'sliders',
            'leftArticles',
            'rightArticles',
            'events',
            'banners',
            'todayVisitors',
            'sixMonthsVisitors',
            'yesterdayVisitors',
            'onlineVisitors'
        ));
    }



    public function articleDetail($slug)
    {
        $articleDetail = Article::with('category')
            ->bySlug($slug)
            ->active()
            ->firstOrFail();

        $relatedArticles = Article::with('category')
            ->byArticleSlug($articleDetail->category->slug ?? "")
            ->active()
            ->orderBy('created_at', 'DESC')
            ->whereNotIn('id', [$articleDetail->id ?? 0])
            ->paginate(12);

        $leftMenuCategory = Category::bySlug('structure-of-sambor-prei-kuk-national-authority')->firstOrFail();

        $leftMenus = Menu::byType('left-menu')
            ->orderBy('id', 'ASC')
            ->get();

        $leftArticlesDetail = Article::byArticleSlug('left-articles-details')
            ->homeArticles()
            ->get();

        // Get visitor statistics
        $todayVisitors = totalVisitor(Period::days(1));
<<<<<<< HEAD
        // Assuming you started tracking from January 1, 2010
        $startDate = Carbon::createFromDate(2010, 1, 1);
        // Set end date as today
        $endDate = Carbon::today();
        $sixMonthsVisitors =
            totalVisitor(Period::create($startDate, $endDate));
=======
        $sixMonthsVisitors = totalVisitor(Period::months(6));
>>>>>>> 7f2a4f0206a956790412a04a33507749210dfd68
        $yesterdayVisitors = totalVisitor(Period::create(Carbon::yesterday(), Carbon::yesterday()));
        $onlineVisitors = totalVisitor(Period::create(Carbon::now(), Carbon::now()));

        return view('frontend/article/detail', compact(
            'articleDetail',
            'relatedArticles',
            'leftMenus',
            'leftArticlesDetail',
            'leftMenuCategory',
            'todayVisitors',
            'sixMonthsVisitors',
            'yesterdayVisitors',
            'onlineVisitors'
        ));
    }
}
