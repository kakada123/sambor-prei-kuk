<?php

use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::controller(MenuController::class)->group(function () {
    // CRUD
    Route::group(['prefix' => 'menus', 'as' => 'menu.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create/{menuType}', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('edit/{menu}/{menuType}', 'edit')->name('edit');
        Route::post('update/{menu}', 'update')->name('update');
        Route::get('destroy/{menu}', 'destroy')->name('destroy');
        Route::get('show/{menuType}', 'show')->name('show');
        Route::post('upload-image', 'uploadImage')->name('uploadImage');
    });
});
