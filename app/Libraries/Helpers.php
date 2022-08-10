<?php
namespace App\Libraries;

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
}
