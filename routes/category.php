<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::controller(CategoryController::class)->group(function () {
    // CRUD
    Route::group(['prefix' => 'categories', 'as' => 'category.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('edit/{category}', 'edit')->name('edit');
        Route::post('update/{category}', 'update')->name('update');
        Route::get('destroy/{category}', 'destroy')->name('destroy');
        Route::get('show/{category}', 'show')->name('show');
    });
});
