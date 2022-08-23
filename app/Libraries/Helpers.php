<?php
namespace App\Libraries;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;


class Helpers {
    public static function uploadFile($file) {

        $cover = null;
        if ($file) {
            $img = $file;
            $cover = time() . '.' . $img->getClientOriginalExtension();
            $path = public_path('/covers');
            $img->move($path, $cover);
        }

        return $cover;
    }

    public static function checkCanRemoveAdminPermission($user, $req) {

        if ($req != 1 &&
            $user->id == Auth::user()->id) {
            return false;
        } else {
            return true;
        }
    }

    public static function getSlug($model, $title) {

        $myslug = $model->where('slug', Str::slug($title))->count();
        if ($myslug == 0) {
            $slug = Str::slug($title);
        } else {
            $slug = Str::slug($title) . '-' . $model->sortByDesc('id')->first()->id;
        }

        return $slug;
    }
}
