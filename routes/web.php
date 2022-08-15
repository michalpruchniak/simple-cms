<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
})->name('welcome');

Auth::routes();

Route::get('/loc/{locale?}',
            [LocalizationController::class, 'setLocalization'])
            ->name('setLocale');

Route::get('/home',
            [HomeController::class, 'index'])
            ->middleware(['Localization'])
            ->name('home');

Route::get('/article/{slug}',
            [ArticleController::class, 'show'])
            ->middleware(['Localization'])
            ->name('article');

Route::get('/category/{slug}',
            [CategoryController::class, 'showArticlesFromCategory'])
            ->middleware(['Localization'])
            ->name('category.articlesFromCategory');

Route::get('/contact',
            [MailController::class, 'show'])
            ->middleware(['Localization'])
            ->name('contact');

Route::post('/contact/send',
            [MailController::class, 'send'])
            ->name('contact.send');

Route::get('/contact/acknowledgement',
           [MailController::class, 'acknowledgement'])
           ->middleware(['Localization'])
           ->name('contact.acknowledgement');


Route::prefix('panel')->middleware(['Localization', 'auth'])->group(function() {
    Route::get('/article/create',
                [ArticleController::class, 'create'])
                ->name('article.create');

    Route::post('/article/store',
                [ArticleController::class, 'store'])
                ->name('article.store');
});

Route::prefix('admin')->middleware((['AdminPermission']))->group(function() {
    Route::get('/articles/all',
                [AdminController::class, 'allArticles'])
                ->name('admin.allArticles');

    Route::get('/articles/accept/{id}',
                [AdminController::class, 'acceptArticle'])
                ->name('admin.articleAccept');

    Route::get('/articles/delete/{id}',
                [AdminController::class, 'deleteArticle'])
                ->name('admin.articleDelete');

    Route::get('/users/all',
                [AdminController::class, 'allUsers'])
                ->name('admin.allUsers');

    Route::get('/users/delete/{id}',
                [AdminController::class, 'deleteUser'])
                ->name('admin.userDelete');

    Route::get('/users/create',
                [AdminController::class, 'createUser'])
                ->name('admin.userCreate');

    Route::post('/users/store',
                [AdminController::class, 'storeUser'])
                ->name('admin.userStore');

    Route::get('/users/edit/{id}',
                [AdminController::class, 'editUser'])
                ->name('admin.userEdit');

    Route::post('/users/update/{id}',
                [AdminController::class, 'updateUser'])
                ->name('admin.userUpdate');
});



