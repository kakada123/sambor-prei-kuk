<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Models\Article;
use App\Models\ArticleContent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Str;
use App\Models\Language;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('article_contents.name', 'LIKE', "%{$value}%")
                        ->orWhere('category_contents.name', 'LIKE', "%{$value}%");
                });
            });
        });
        $lang = Language::byLocale(App::getLocale())->first();
        $articles = QueryBuilder::for(Article::select('articles.id', 'articles.thumbnail', 'articles.created_at', 'articles.category_id'))
            ->defaultSort('-articles.id')
            ->join('article_contents', 'article_contents.article_id', 'articles.id')
            ->join('category_contents', 'category_contents.category_id', 'articles.category_id')
            ->where('article_contents.lang_id', $lang->id ?? 1)
            ->allowedFilters(['article_contents.name', $globalSearch])
            ->paginate($request->perPage ?? 15)
            ->withQueryString();
        return Inertia::render('Article/Index', [
            'articles' => $articles,
        ])->table(function (InertiaTable $table) {
            $table
                ->column('No')
                ->column('Thumbnail')
                ->column('name', 'Title')
                ->column('category_name', 'Category')
                ->column('created_on', 'Created at')
                ->column('actions', 'Action')
                ->withGlobalSearch();
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryControler = new CategoryController;
        return Inertia::render('Article/CreateArticle', [
            'categories' => $categoryControler->getCategory()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateArticleRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $path = null;
                if ($request->file('thumbnail')) {
                    $thumbnail = $request->file('thumbnail');
                    $ext = '.' . $thumbnail->getClientOriginalExtension();
                    $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $thumbnail->getClientOriginalName());
                    $path = $thumbnail->storeAs('uploads/articles', $fileName, 'public');
                }
                $form = (object)$request->form;
                $slug = Str::slug($form->name_en ?? "");
                $article = Article::create([
                    'category_id' => $form->category ?? null,
                    'status'    => $form->is_active ?? null,
                    'slug' => $slug,
                    'thumbnail' => $path,
                    'created_by' => Auth::user()->id ?? null
                ]);
                if ($slug === "") {
                    $article->slug = 'article-' . $article->id;
                    $article->save();
                }
                $langs = langs();
                foreach ($langs as $lang) {
                    $locale = $lang->locale;
                    $name = 'name_' . $locale;
                    $content = 'content_' . $locale;
                    if ($form->$name or $form->$content) {
                        ArticleContent::create([
                            'article_id' => $article->id ?? "",
                            'lang_id' => $lang->id,
                            'name'    => $form->$name ?? "",
                            'desc'   => $form->$content ?? "",
                            'created_by' => Auth::user()->id ?? null
                        ]);
                    }
                }
            });
        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect()->route('article.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $path = "";
        if (Storage::disk('public')->exists($article->thumbnail ?? "") && $article->thumbnail !== null) {
            $path = "/" . $article->thumbnail;
        }
        $theArticle = [
            'id'            => $article->id,
            'category'      => $article->category?->id ?? null,
            'is_active'     => $article->status ? true : false,
            'thumbnail'     => $path
        ];
        $langs = langs();
        foreach ($langs as $lang) {
            $articleContent = ArticleContent::where([
                'article_id' => $article->id,
                'lang_id' => $lang->id
            ])->first();
            $locale = $lang->locale;
            $name = "name_" . $locale;
            $content = "content_" . $locale;
            $theArticle[$name] = $articleContent->name ?? "";
            $theArticle[$content] = $articleContent->desc ?? "";
        }
        $categoryControler = new CategoryController;
        return Inertia::render('Article/EditArticle', [
            'article' => (object)$theArticle,
            'categories' => $categoryControler->getCategory()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        try {
            DB::transaction(function () use ($request, $article) {
                $path = "";
                if ($request->file('thumbnail')) {
                    $thumbnail = $request->file('thumbnail');
                    $ext = '.' . $thumbnail->getClientOriginalExtension();
                    $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $thumbnail->getClientOriginalName());
                    $path = $thumbnail->storeAs('uploads/articles', $fileName, 'public');
                    $article->thumbnail = $path;
                } else {
                    $file = $article->thumbnail ?? "";
                    if (Storage::disk('public')->exists($file)) {
                        Storage::disk('public')->delete($file);
                    }
                    $article->thumbnail = null;
                }
                $article->save();
                $form = (object)$request->form;
                $slug = Str::slug($form->name_en ?? "");
                $article->update([
                    'category_id' => $form->category ?? null,
                    'status'    => $form->is_active ?? null,
                    'slug' => $slug,
                    'updated_by' => Auth::user()->id ?? null
                ]);
                if ($slug === "") {
                    $article->slug = 'article-' . $article->id;
                    $article->save();
                }
                $langs = langs();
                foreach ($langs as $lang) {
                    $locale = $lang->locale;
                    $name = 'name_' . $locale;
                    $content = 'content_' . $locale;
                    if ($form->$name or $form->$content) {
                        $mathThese = [
                            'article_id' => $article->id ?? "",
                            'lang_id' => $lang->id
                        ];
                        ArticleContent::updateOrCreate($mathThese, [
                            'article_id' => $article->id ?? "",
                            'lang_id' => $lang->id,
                            'name'    => $form->$name ?? "",
                            'desc'   => $form->$content ?? "",
                            'created_by' => Auth::user()->id ?? null
                        ]);
                    }
                }
            });
        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect()->route('article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->deleted_by = Auth::user()->id;
        $article->save();
        $article->delete();
        return redirect()->route('article.index');
    }
    public function uploadImage(Request $request)
    {
        $image = $request->file('file');
        $ext = '.' . $image->getClientOriginalExtension();
        $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $image->getClientOriginalName());
        $path = $request->file('file')->storeAs('uploads', $fileName, 'public');
        return response()->json([
            'location' => asset($path)
        ]);
    }
    /**
     * Get Articles by category
     * @param  $categoryId
     * @return $selecteArticles
     */
    public function articleByCategory($categoryId)
    {
        $articles = Article::byCategory($categoryId)->get();
        $selecteArticles = [];
        foreach ($articles as $key => $article) {
            $selecteArticles[$key] = [
                'value' =>  $article->id,
                'label' =>  $article->name
            ];
        }
        return $selecteArticles;
    }
    /**
     * Get Articles by category
     * @param  $categoryId
     * @return \Illuminate\Http\Response
     */
    public function getArticleByCategory($categoryId)
    {
        $selecteArticles = $this->articleByCategory($categoryId);
        return response()->json([
            'articles' => $selecteArticles
        ], 200);
    }
}
