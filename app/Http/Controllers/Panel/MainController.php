<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Category;

class MainController extends Controller
{
    public function index()
    {
        $categories = Category::where('published', true)->orderBy('ordering')->get();

        return view('panel.index', compact('categories'));
    }
}
