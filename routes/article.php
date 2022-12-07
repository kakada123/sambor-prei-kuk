<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::controller(ArticleController::class)->group(function () {
    // CRUD
    Route::group(['prefix' => 'articles', 'as' => 'article.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('edit/{article}', 'edit')->name('edit');
        Route::post('update/{article}', 'update')->name('update');
        Route::get('destroy/{article}', 'destroy')->name('destroy');
        Route::get('show/{article}', 'show')->name('show');
        Route::post('upload-image', 'uploadImage')->name('uploadImage');
    });
});
