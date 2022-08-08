<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocalizationController extends Controller
{
    public function setLocalization($locale,Request $request){
        $request->session()->put('localization', $locale);
        return redirect()->route('home');
    }
}
