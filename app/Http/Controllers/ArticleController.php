<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $thumbnail = $request->file('thumbnail');
                $ext = '.' . $thumbnail->getClientOriginalExtension();
                $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $thumbnail->getClientOriginalName());
                $path = $thumbnail->storeAs('uploads/articles', $fileName, 'public');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
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
}
