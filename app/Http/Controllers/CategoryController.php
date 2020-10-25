<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

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

    public function create()
    {
        $categories = Category::get();
        return view('admin.categories.create',compact('categories') );
    }

    public function store(Request $request)
    {
    	$request->validate([
            'name'=>'required',
        ]);
        $input = $request->all();
        Category::create($input);
   
        return back();
    }

    public function edit($id)
    {
        $categories = Category::get();
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category','categories'));
    }

    public function update(Request $request, $cat_id)
    {
        request()->validate([
            'name' => 'required',
        ]);
        $cat = Category::find($cat_id);

        $cat->update($request->all());
        
        return redirect()->route('index_cat');
    }

    public function destroy($cat_id)
    {
        $cat = Category::find($cat_id);
        $cat->delete();
        return redirect()->route('index_cat');
    }
}
