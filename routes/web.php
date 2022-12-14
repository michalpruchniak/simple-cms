<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\CaptchaController;
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


Route::get('/loc/{locale?}',
            [LocalizationController::class, 'setLocalization'])
            ->name('setLocale');

Route::post('/contact/send',
            [MailController::class, 'send'])
            ->name('contact.send');

Route::middleware((['Localization']))->group(function() {

    Auth::routes();

    Route::get('/',
                [ArticleController::class, 'showAllArticles'])
                ->name('welcome');

    Route::get('/reload-captcha',
                [CaptchaController::class, 'reloadCaptcha'])
                ->name('captcha.reload');

    Route::get('/article/{slug}',
                [ArticleController::class, 'show'])
                ->name('article');

    Route::get('/category/{slug}',
                [ArticleController::class, 'showArticlesFromCategory'])
                ->name('category.articlesFromCategory');

    Route::get('/contact',
                [MailController::class, 'show'])
                ->name('contact');

    Route::get('/contact/acknowledgement',
                [MailController::class, 'acknowledgement'])
                ->name('contact.acknowledgement');
});

Route::prefix('panel')->middleware(['Localization', 'auth'])->group(function() {

    Route::get('article/all',
                [ArticleController::class, 'allUserArticle'])
                ->name('article.all');

    Route::get('/article/create',
                [ArticleController::class, 'create'])
                ->name('article.create');

    Route::post('/article/store',
                [ArticleController::class, 'store'])
                ->name('article.store');

    Route::get('/article/edit/{id}',
                [ArticleController::class, 'edit'])
                ->name('article.edit');

    Route::post('/article/update/{id}',
                [ArticleController::class, 'update'])
                ->name('article.update');

    Route::post('/articles/delete',
                [ArticleController::class, 'deleteArticle'])
                ->name('article.delete');
});

Route::prefix('admin')->middleware((['AdminPermission']))->group(function() {
    Route::get('/articles/all',
                [AdminController::class, 'allArticles'])
                ->name('admin.article.all');

    Route::get('/articles/accept/{id}',
                [AdminController::class, 'acceptArticle'])
                ->name('admin.article.accept');

    Route::post('/articles/delete',
                [AdminController::class, 'deleteArticle'])
                ->name('admin.article.delete');

    Route::get('/users/all',
                [AdminController::class, 'allUsers'])
                ->name('admin.user.all');

    Route::post('/users/delete',
                [AdminController::class, 'deleteUser'])
                ->name('admin.user.delete');

    Route::get('/users/create',
                [AdminController::class, 'createUser'])
                ->name('admin.user.create');

    Route::post('/users/store',
                [AdminController::class, 'storeUser'])
                ->name('admin.user.store');

    Route::get('/users/edit/{id}',
                [AdminController::class, 'editUser'])
                ->name('admin.user.edit');

    Route::post('/users/update/{id}',
                [AdminController::class, 'updateUser'])
                ->name('admin.user.update');
});



