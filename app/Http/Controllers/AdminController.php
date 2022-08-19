<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Libraries\Helpers;
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

    public function deleteArticle(Request $request) {

        $article = Article::findOrFail($request->articleId);

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

        return redirect()->route('admin.user.all');
    }

    public function editUser($id) {
        $user = User::findOrFail($id);

        return view('admin.user', [
            'user' => $user
        ]);
    }

    public function updateUser($id, UserUpdateRequest $request) {
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->admin = $request->admin;

        if (!Helpers::checkCanRemoveAdminPermission($user, $request->admin)) {
            return view('messagePage.error', ['message' => 'you cant remove admin permission yourself']);
        }

        if (isset($request->password)) {
            $user->password = $request->password;
        }

        $user->save();

        return redirect()->route('admin.user.all');

    }

    public function deleteUser(Request $request)
    {
        $user = User::findOrFail($request->userId);
        if($user->id == Auth::user()->id) {
            return view('messagePage.error', ['message' => 'you cant remove yourself account']);

        }

        $user->articles()->delete();
        $user->delete();

        return redirect()->back();
    }

}
