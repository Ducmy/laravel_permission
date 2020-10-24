<?php

namespace App\Http\Controllers;

use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get();

        return view('admin.categories.index', compact('categories'));
    }
}
