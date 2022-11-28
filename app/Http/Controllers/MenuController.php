<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MenuController extends Controller
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
        //
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
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
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
}
