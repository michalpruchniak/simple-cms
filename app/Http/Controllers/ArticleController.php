<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleStoreRequest;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function create() {
        return view('article.create');
    }

    public function store(ArticleStoreRequest $request) {
        Article::create([
            'title' => $request->title,
            'description' => $request->description
        ]);
        echo "Hello Honey";
    }
}
