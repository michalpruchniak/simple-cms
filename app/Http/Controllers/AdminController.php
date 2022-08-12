<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function allArticles() {
        $articles = Article::orderBy('id', 'desc')->get();

        return view('admin.allArticles', [
            'articles' => $articles
        ]);
    }
}
