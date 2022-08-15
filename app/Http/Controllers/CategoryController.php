<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showArticlesFromCategory($slug) {

        $category = Category::where('slug', $slug)->firstOrFail();

        return view('frontend.category.articlesFromCategory', [
            'category' => $category
        ]);
    }
}
