<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.pages.categories.show', compact('categories'));
    }
    public function add()
    {
        return view('admin.pages.categories.add');
    }
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    Category::create([
        'name' => $request->name,
    ]);

    return redirect()->back()->with('success', 'Category added successfully!');
}

public function edit($id)
{
    $category = Category::findOrFail($id);
    return view('admin.pages.categories.edit', compact('category'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $category = Category::findOrFail($id);
    $category->update(['name' => $request->name]);

    return redirect()->route('showCategories')->with('success', 'Category updated successfully!');
}

public function destroy($id)
{
    $category = Category::findOrFail($id);
    $category->delete();

    return redirect()->route('showCategories')->with('success', 'Category deleted successfully!');
}


}
