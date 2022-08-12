<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function allArticles() {
        $articles = Article::orderBy('id', 'desc')->get();

        return view('admin.allArticles', [
            'articles' => $articles
        ]);
    }

    public function acceptArticle($id) {

        $article = Article::findOrFail($id);

        $article->accept = !$article->accept;
        $article->save();

        return redirect()->back();
    }

    public function deleteArticle($id) {

        $article = Article::findOrFail($id);

        $article->delete();

        return redirect()->back();
    }

    public function allUsers()
    {
        $users = User::orderBy('id', 'desc')->get();

        return view('admin.allUsers', [
            'users' => $users
        ]);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back();
    }
}
