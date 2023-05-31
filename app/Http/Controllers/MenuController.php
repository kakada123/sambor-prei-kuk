<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuContent;
use App\Models\MenuType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Inertia\Inertia;
use App\Models\Language;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = 'name_' . App::getLocale();
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) use ($name) {
            $query->where(function ($query) use ($value, $name) {
                Collection::wrap($value)->each(function ($value) use ($query, $name) {
                    $query
                        ->orWhere('menu_types.' . $name, 'LIKE', "%{$value}%");
                });
            });
        });
        $menus = QueryBuilder::for(MenuType::class)
            ->allowedFilters(['menu_types.' . $name, $globalSearch])
            ->paginate($request->perPage ?? 15)
            ->withQueryString();
        return Inertia::render('Menu/Index', [
            'menus' => $menus,
        ])->table(function (InertiaTable $table) use ($name) {
            $table
                ->column('id', 'No')
                ->column($name, 'Name')
                ->column('actions', 'Action')
                ->withGlobalSearch();
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(MenuType $menuType, Request $request)
    {
        $menu_id = $request->menu ?? null;
        $menu = Menu::find($menu_id);
        $name = 'name_' . App::getLocale();
        $categoryControler = new CategoryController;
        return Inertia::render('Menu/CreateMenu', [
            'menus' => $this->getMenu($menuType->slug ?? ""),
            'menu_type_name' => $menuType->$name ?? "",
            'menuType' => $menuType->slug ?? "",
            'categories' => $categoryControler->getCategory(),
            'menu_id' => $menu_id,
            'menu_name' => $menu->name ?? "",
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
            //code...
            DB::transaction(function () use ($request) {
                // Menu
                $slug = Str::slug($request->name_en ?? "");
                $menu = Menu::create([
                    'category_id' => $request->category ?? null,
                    'article_id' => $request->article ?? null,
                    'type' => $request->menuType,
                    'parent_id' => $request->parent ?? null,
                    'status' => $request->is_active ?? null,
                    'order' => $request->order ?? 0,
                    'slug' => $slug,
                    'created_by' => Auth::user()->id ?? null
                ]);
                if ($slug === "") {
                    $menu->slug = 'menu-' . $menu->id;
                    $menu->save();
                }
                $langs = langs();
                foreach ($langs as $lang) {
                    $locale = $lang->locale;
                    $name = 'name_' . $locale;
                    $description = 'description_' . $locale;
                    if ($request->$name or $request->$description) {
                        MenuContent::create([
                            'menu_id' => $menu->id ?? null,
                            'lang_id' => $lang->id,
                            'name'    => $request->$name ?? "",
                            'description'   => $request->$description ?? ""
                        ]);
                    }
                }
            });
            // Clear Menu Caches
            $this->clearMenusCache();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('app.created_fail'));;
        }
        return redirect()->route('menu.show', $request->menuType ?? "");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(MenuType $menuType)
    {
        $name = 'name_' . App::getLocale();
        return Inertia::render('Menu/ShowMenu', [
            'menus' => $this->getMenu($menuType->slug ?? ""),
            'menu_type_name' => $menuType->$name ?? "",
            'menuType' => $menuType->slug ?? "",
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu, MenuType $menuType)
    {

        $theMenu = [
            'category'      => $menu->category_id ?? "",
            'article'       => $menu->article_id ?? "",
            'is_active'     => $menu->status ? true : false,
            'parent'        => $menu->parent_id ?? "",
            'menuType'      => $menu->type ?? "",
            'order'         => $menu->order ?? 0
        ];

        $langs = langs();
        foreach ($langs as $lang) {
            $menuContent = MenuContent::where([
                'menu_id' => $menu->id,
                'lang_id' => $lang->id
            ])->first();
            $locale = $lang->locale;
            $name = "name_" . $locale;
            $description = "description_" . $locale;
            $theMenu[$name] = $menuContent->name ?? "";
            $theMenu[$description] = $menuContent->description ?? "";
        }

        $name = 'name_' . App::getLocale();
        $categoryControler = new CategoryController;
        $articleController = new ArticleController;
        $articles = $articleController->articleByCategory($menu->category_id ?? null);
        return Inertia::render('Menu/EditMenu', [
            'menus' => $this->getMenu($menuType->slug ?? ""),
            'menu_type_name' => $menuType->$name ?? "",
            'menuType' => $menuType->slug ?? "",
            'categories' => $categoryControler->getCategory(),
            'menu' => $theMenu,
            'articles' => $articles,
            'menu_id' => $menu->id ?? "",
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        try {
            //code...
            DB::transaction(function () use ($request, $menu) {
                // Menu
                $slug = Str::slug($request->name_en ?? "");
                $menu->update([
                    'category_id' => $request->category ?? null,
                    'article_id' => $request->article ?? null,
                    'type' => $request->menuType,
                    'parent_id' => $request->parent ?? null,
                    'status' => $request->is_active ?? null,
                    'order' => $request->order ?? 0,
                    'slug' => $slug,
                    'updated_by' => Auth::user()->id ?? null
                ]);
                if ($slug === "") {
                    $menu->slug = 'menu-' . $menu->id;
                    $menu->save();
                }
                $langs = langs();
                foreach ($langs as $lang) {
                    $locale = $lang->locale;
                    $name = 'name_' . $locale;
                    $description = 'description_' . $locale;
                    if ($request->$name or $request->$description) {
                        $mathThese = [
                            'menu_id' => $menu->id ?? null,
                            'lang_id' => $lang->id,
                        ];
                        MenuContent::updateOrcreate($mathThese, [
                            'menu_id' => $menu->id ?? null,
                            'lang_id' => $lang->id,
                            'name'    => $request->$name ?? "",
                            'description'   => $request->$description ?? ""
                        ]);
                    }
                }
            });
            // Clear Menu Caches
            $this->clearMenusCache();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('app.created_fail'));;
        }
        return redirect()->route('menu.show', $request->menuType ?? "");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->deleted_by = Auth::user()->id;
        $menu->save();
        $menu->delete();
        return redirect()->route('menu.show', $menu->type ?? "");
    }
    public function getMenu($menuType)
    {
        $menus = Menu::orderBy('order', 'ASC')->byType($menuType)->parent()->get();
        $theMenus = [];
        foreach ($menus as $menu) {
            $theMenus[$menu->id] = [
                'label'         => $menu->name,
                'id'            => $menu->id,
                'value'         => $menu->id,
                'description'   => $menu->description
            ];
            if ($menu->children) {
                foreach ($menu->children as $child) {
                    $theMenus[$menu->id]['children'][] = [
                        'label' => $child->name,
                        'id'    => $child->id,
                        'value'    => $child->id,
                        'description'   => $menu->description,
                        'children' => $this->childMenu($child)
                    ];
                }
            }
        }
        return array_values($theMenus);
    }
    public function childMenu($menu)
    {
        $subMenus = [];
        if ($menu->children) {
            foreach ($menu->children as $child) {
                $subMenus[] = [
                    'label' => $child->name,
                    'id'    => $child->id,
                    'value'    => $child->id,
                    'description'   => $menu->description,
                    'children' => $this->childMenu($child)
                ];
                Self::childMenu($child);
            }
            return array_values($subMenus);
        }
    }

    private function clearMenusCache()
    {
        $langs = langs();
        foreach ($langs as $lang) {
            $cacheKey = 'main_menus_' . $lang->locale;
            Cache::forget($cacheKey);
        }
    }
}
