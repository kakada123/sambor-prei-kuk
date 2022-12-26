<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ . '/frontend.php';

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});
Route::get('/symlink', function () {
    $target = $_SERVER['DOCUMENT_ROOT'] . '/storage/app/public';
    $link = $_SERVER['DOCUMENT_ROOT'] . '/public/storage';
    symlink($target, $link);
    echo "Done";
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => ['auth', 'verified']], function () {
    require __DIR__ . '/category.php';
    require __DIR__ . '/article.php';
    require __DIR__ . '/menu.php';
});
require __DIR__ . '/auth.php';
