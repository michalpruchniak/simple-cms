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
        $cover = null;
        if ($request->hasFile('file')) {
            $img = $request->file('file');
            $cover = time() . '.' . $img->getClientOriginalExtension();
            $path = public_path('/covers');
            $img->move($path, $cover);
        }
        Article::create([
            'title' => $request->title,
            'description' => $request->description,
            'cover' => $cover
        ]);

    }
}
