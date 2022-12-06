<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryContent;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Category/Index', [
            'categories' => $this->getCategory()
        ]);
    }
    public function getCategory()
    {
        $categories = Category::parent()->get();
        $theCategories = [];
        foreach ($categories as $category) {
            $theCategories[$category->id] = [
                'label'         => $category->name,
                'id'            => $category->id,
                'value'         => $category->id,
                'description'   => $category->description
            ];
            if ($category->children) {
                foreach ($category->children as $child) {
                    $theCategories[$category->id]['children'][] = [
                        'label' => $child->name,
                        'id'    => $child->id,
                        'value'    => $child->id,
                        'description'   => $category->description,
                        'children' => $this->childCategory($child)
                    ];
                }
            }
        }
        return array_values($theCategories);
    }
    public function childCategory($category)
    {
        $subCategories = [];
        if ($category->children) {
            foreach ($category->children as $child) {
                $subCategories[] = [
                    'label' => $child->name,
                    'id'    => $child->id,
                    'value'    => $child->id,
                    'description'   => $category->description,
                    'children' => $this->childCategory($child)
                ];
                Self::childCategory($child);
            }
            return array_values($subCategories);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Category/CreateCategory', [
            'categories' => $this->getCategory()
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
                // Category
                $slug = Str::slug($request->name_en ?? "");
                $category = Category::create([
                    'parent_id' => $request->parent ?? null,
                    'status'    => $request->is_active ?? null,
                    'slug' => $slug,
                    'created_by' => Auth::user()->id ?? null
                ]);
                if ($slug === "") {
                    $category->slug = 'category-' . $category->id;
                    $category->save();
                }
                $langs = langs();
                foreach ($langs as $lang) {
                    $locale = $lang->locale;
                    $name = 'name_' . $locale;
                    $description = 'description_' . $locale;
                    if ($request->$name or $request->$description) {
                        CategoryContent::create([
                            'category_id' => $category->id ?? null,
                            'lang_id' => $lang->id,
                            'name'    => $request->$name ?? "",
                            'description'   => $request->$description ?? ""
                        ]);
                    }
                }
            });
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('app.created_fail'));;
        }
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $theCategory = [
            'category_id'   => $category->id,
            'is_active'     => $category->status ? true : false,
            'parent'        => $category->id,
            'parent_name'   => $category->name
        ];
        $langs = langs();
        foreach ($langs as $lang) {
            $categoryContent = CategoryContent::where([
                'category_id' => $category->id,
                'lang_id' => $lang->id
            ])->first();
            $locale = $lang->locale;
            $name = "name_" . $locale;
            $description = "description_" . $locale;
            $theCategory[$name] = $categoryContent->name ?? "";
            $theCategory[$description] = $categoryContent->description ?? "";
        }
        return Inertia::render('Category/EditCategory', [
            'category' => (object)$theCategory,
            'categories' => $this->getCategory()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        try {
            DB::transaction(function () use ($request, $category) {
                // Category
                $slug = Str::slug($request->name_en ?? "");
                $category->update([
                    'status'    => $request->is_active ?? null,
                    'slug' => $slug,
                    'updated_by' => Auth::user()->id ?? null
                ]);
                if ($slug === "") {
                    $category->slug = 'category-' . $category->id;
                    $category->save();
                }
                $langs = langs();
                foreach ($langs as $lang) {
                    $locale = $lang->locale;
                    $name = 'name_' . $locale;
                    $description = 'description_' . $locale;
                    if ($request->$name or $request->$description) {
                        $matchThese = [
                            'category_id' => $category->id ?? null,
                            'lang_id' => $lang->id,
                        ];
                        CategoryContent::updateOrCreate($matchThese, [
                            'category_id' => $category->id ?? null,
                            'lang_id' => $lang->id,
                            'name'    => $request->$name ?? "",
                            'description'   => $request->$description ?? ""
                        ]);
                    }
                }
            });
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('app.updated_fail'));;
        }
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->deleted_by = Auth::user()->id;
        $category->save();
        $category->delete();
        return redirect()->route('category.index');
    }
}
