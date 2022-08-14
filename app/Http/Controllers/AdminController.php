<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function createUser()
    {
        return view('admin.user');
    }

    public function storeUser(UserStoreRequest $request)
    {
        User::create([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'admin' => $request->admin
        ]);

        return redirect()->route('admin.allUsers');
    }

    public function editUser($id) {
        $user = User::findOrFail($id);

        return view('admin.user', [
            'user' => $user
        ]);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back();
    }

}
