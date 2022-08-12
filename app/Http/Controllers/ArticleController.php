<?php

namespace App\Http\Controllers;

use App\Libraries\Helpers;
use App\Http\Requests\ArticleStoreRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function create() {

        $categories = Category::orderBy('name', 'asc')
                              ->get();

        return view('article.create', [
            'categories' => $categories
        ]);

    }

    public function store(ArticleStoreRequest $request) {

        $cover = Helpers::uploadFile($request->file('file'));

        Article::create([
            'title' => $request->title,
            'description' => $request->description,
            'cover' => $cover
        ]);

    }
}
