<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.pages.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.pages.categories.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ], [
            'name.unique' => "The category '{$request->name}' has already been added.",
            'name.required' => "The category '{$request->name}' has already been added.",
        ]);

        $category = Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.create')->with('success', "Category '{$category->name}' added successfully!");
    }

    public function edit(Category $category)
    {
        return view('admin.pages.categories.edit', compact('category'));
    }


    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ], [
            'name.unique' => "The category '{$request->name}' has already been added.",
            'name.required' => "The category '{$request->name}' has already been added.",
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index')->with('success', "Category '{$category->name}' updated successfully!");
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', "Category '{$category->name}' deleted successfully!");
    }
}
