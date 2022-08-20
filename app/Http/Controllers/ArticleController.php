<?php

namespace App\Http\Controllers;

use App\Libraries\Helpers;
use App\Http\Requests\ArticleStoreRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ArticleController extends Controller
{
    public function showAllArticles()
    {
        $articles = Article::where('accept', 1)
                           ->where('lang', Session::get('localization'))
                           ->orderBy('id', 'asc')
                           ->get();

        return view('frontend.articles.allArticles', [
            'title'    => 'all articles',
            'articles' => $articles
        ]);
    }
    public function showArticlesFromCategory($slug)
    {

        $category = Category::where('slug', $slug)
                            ->firstOrFail();

        $articles = $category->articles()
                             ->where('accept', 1)
                             ->where('lang', Session::get('localization'))
                             ->get();

        return view('frontend.articles.allArticles', [
            'title' => $category->name,
            'articles' => $articles
        ]);
    }

    public function show($slug) {

        $article = Article::where('slug', $slug)->firstOrFail();

        return view('frontend.articles.single', [
            'article' => $article
        ]);
    }

    public function create() {

        $categories = Category::orderBy('name', 'asc')
                              ->get();

        return view('article.create', [
            'categories' => $categories
        ]);

    }

    public function store(ArticleStoreRequest $request) {

        $article = Article::all();
        $cover = Helpers::uploadFile($request->file('file'));
        $slug = Helpers::getSlug($article, $request->title);

        Article::create([
            'user_id'     => Auth::user()->id,
            'title'       => $request->title,
            'description' => $request->description,
            'category_id' => $request->category,
            'cover'       => $cover,
            'lang'        => $request->language,
            'slug'        => $slug
        ]);

    }

    public function allUserArticle() {
        $articles = Auth::user()->articles;
        return view('article.articles', [
            'title' => 'all articles',
            'articles' => $articles
        ]);
    }

    public function deleteArticle(Request $request)
    {

        $article = Article::findOrFail($request->articleId);

        if($article->user_id == Auth::user()->id) {
            $article->delete();

            return redirect()->back();
        } else {
            return view('messagePage.error', ['message' => 'You dont have permission to this action']);
        }

    }
}
