<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

Route::prefix(LaravelLocalization::setLocale())->middleware(['localeSessionRedirect', 'localizationRedirect'])->group(function () {
    Route::controller(FrontendController::class)->group(function () {
        Route::get('/', 'index')->name('home');
        Route::get('article/{slug}', 'articleDetail')->name('article_detail');
    });
});
