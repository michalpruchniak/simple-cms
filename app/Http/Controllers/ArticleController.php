<?php

namespace App\Http\Controllers;

use App\Libraries\Helpers;
use App\Http\Requests\ArticleStoreRequest;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function showAllArticles()
    {

        $articles = Article::where('accept', 1)
            ->orderBy('id', 'asc')
            ->get();

        return view('article.articles', [
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
            ->get();

        return view('article.articles', [
            'title' => $category->name,
            'articles' => $articles
        ]);
    }

    public function show($slug) {

        $article = Article::where('slug', $slug)->firstOrFail();

        return view('article.single', [
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
            'slug'        => $slug
        ]);

    }
}
