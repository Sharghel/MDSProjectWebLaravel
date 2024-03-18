<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index() {
        // $categories = Category::where('parent_id', null)->get();
        $categories = Category::where('parent_id', null)->with('children')->get();
        // dd($categories[0]);

        return view('categories.index', compact('categories'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->update($request->all());
        return redirect()->route('category.index');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('category.index');
    }

    public function edit($id)
    {
        $categories = Category::where('parent_id', null)->with('children')->get();

        $category = Category::find($id);
        $parent_categories = Category::where('parent_id', null)->get();
        return view('categories.edit', compact('categories', 'category', 'parent_categories'));
    }

    // public function create() {
        
    //     return view('categories.create')
    // }

}
