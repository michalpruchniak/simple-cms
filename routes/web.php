<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalizationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Route::get('/', function () {
    return view('welcome');
})->middleware(['AdminPermission', 'Localization'])->name('welcome');

Auth::routes();

Route::get('/loc/{locale?}',
            [LocalizationController::class, 'setLocalization']);

Route::get('/home',
            [HomeController::class, 'index'])
            ->middleware(['Localization'])
            ->name('home');

Route::prefix('panel')->middleware(['Localization', 'auth'])->group(function() {
    Route::get('/article/create',
                [ArticleController::class, 'create'])
                ->name('article.create');

    Route::post('/article/store',
                [ArticleController::class, 'store'])
                ->name('article.store');
});

Route::prefix('admin')->middleware((['AdminPermission']))->group(function() {
    Route::get('/admin/all-articles',
                [AdminController::class, 'allArticles'])
                ->name('admin.allArticles');

    Route::get('/admin/article-accept/{id}',
                [AdminController::class, 'acceptArticle'])
                ->name('admin.articleAccept');
});



