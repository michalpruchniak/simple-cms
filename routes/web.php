<?php

use App\Http\Controllers\ArticleController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['Localization'])->name('home');
Route::get('/panel/article/create', [ArticleController::class, 'create'])->name('article.create')->middleware((['Localization']));
Route::post('/panel/article/store', [ArticleController::class, 'store'])->name('article.store');

Route::get('/loc/{locale?}', [LocalizationController::class, 'setLocalization']);
