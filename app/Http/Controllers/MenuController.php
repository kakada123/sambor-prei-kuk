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
        $name = 'name_' . App::getLocale();
        $categoryControler = new CategoryController;
        return Inertia::render('Menu/CreateMenu', [
            'menus' => $this->getMenu($menuType),
            'menu_type_name' => $menuType->$name,
            'menuType' => $menuType->slug,
            'categories' => $categoryControler->getCategory()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $category)
    {
        DB::transaction(function () use ($request, $category) {
            // Menu
            $slug = Str::slug($request->name_en ?? "");
            $menu = Menu::create([
                'category_id' => $category->id ?? null,
                'parent_id' => $request->parent ?? null,
                'status' => $request->is_active ?? null,
                'slug' => $slug
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
            'menus' => $this->getMenu($menuType),
            'menu_type_name' => $menuType->$name,
            'menuType' => $menuType->slug,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
    }
    public function getMenu($menuType)
    {
        $menus = Menu::byType($menuType)->parent()->get();
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
}
