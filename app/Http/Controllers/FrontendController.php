<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Spatie\Analytics\Period;

class FrontendController extends Controller
{
    /**
     * Homepage
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $locale = App::getLocale();

        $articleSlugs = ['under-slider-articles', 'left-articles', 'right-articles', 'banners'];
        $articles = $this->getArticlesGroupedByCategory($locale, $articleSlugs);

        $events = $this->getEvents();

        // Retrieve the specific article categories
        $sliders = $articles['under-slider-articles'] ?? collect();
        $leftArticles = $articles['left-articles'] ?? collect();
        $rightArticles = $articles['right-articles'] ?? collect();
        $banners = $articles['banners'] ?? collect();

        $todayVisitors = $this->visitorsToday();
        $allTimeVisitors = $this->allTimeVisitors();
        $yesterdayVisitors = $this->visitorsYesterday();
        $onlineVisitors = $this->onlineVisitors();

        return view('frontend/index', compact(
            'sliders',
            'leftArticles',
            'rightArticles',
            'events',
            'banners',
            'todayVisitors',
            'allTimeVisitors',
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

        $relatedArticles = $this->getRelatedArticles($articleDetail);

        $leftMenuCategory = Category::bySlug('structure-of-sambor-prei-kuk-national-authority')->firstOrFail();
        $leftMenus = Menu::byType('left-menu')->orderBy('id', 'ASC')->get();
        $leftArticlesDetail = Article::byArticleSlug('left-articles-details')->homeArticles()->get();

        $todayVisitors = $this->visitorsToday();
        $allTimeVisitors = $this->allTimeVisitors();
        $yesterdayVisitors = $this->visitorsYesterday();
        $onlineVisitors = $this->onlineVisitors();

        return view('frontend/article/detail', compact(
            'articleDetail',
            'relatedArticles',
            'leftMenus',
            'leftArticlesDetail',
            'leftMenuCategory',
            'todayVisitors',
            'allTimeVisitors',
            'yesterdayVisitors',
            'onlineVisitors'
        ));
    }

    private function getArticlesGroupedByCategory($locale, $slugs)
    {
        return Article::whereHas('category', function ($query) use ($locale, $slugs) {
            $query->whereIn('slug', $slugs);
        })->with('category')->get()->groupBy('category.slug');
    }

    private function getEvents()
    {
        return Article::byArticleSlug('news-and-events')
            ->orderBy('order', 'ASC')
            ->take(4)
            ->active()
            ->orderBy('created_at', 'DESC')
            ->paginate(6);
    }

    private function getRelatedArticles($articleDetail)
    {
        return Article::with('category')
            ->byArticleSlug($articleDetail->category->slug ?? "")
            ->active()
            ->orderBy('created_at', 'DESC')
            ->whereNotIn('id', [$articleDetail->id ?? 0])
            ->paginate(12);
    }

    private function getVisitorStatisticsForPeriod($months)
    {
        $startDate = Carbon::today()->subMonths($months);
        $endDate = Carbon::today();

        return Visitor::whereBetween('last_visit', [$startDate, $endDate])->count();
    }

    public function onlineVisitors()
    {
        $onlineVisitors = Visitor::where('last_visit', '>=', now()->subMinutes(5))->count();
        return $onlineVisitors;
    }

    public function visitorsToday()
    {
        $visitorsToday = Visitor::whereDate('last_visit', now())->count();
        return $visitorsToday;
    }

    public function visitorsYesterday()
    {
        $visitorsYesterday = Visitor::whereDate('last_visit', now()->subDay())->count();
        return $visitorsYesterday;
    }

    public function allTimeVisitors()
    {
        $allTimeVisitors = Visitor::count();
        return $allTimeVisitors + Visitor::OLD_DATA;
    }
}
