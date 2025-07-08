<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->get();
        return view('admin.pages.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        return view('admin.pages.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'parent_id' => 'nullable|exists:categories,id',
        ], [
            'name.unique' => "The category '{$request->name}' has already been added.",
            'name.required' => "The category '{$request->name}' has already been added.",
        ]);

        $category = Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('categories.create')->with('success', "Category '{$category->name}' added successfully!");
    }

    public function edit(Category $category)
    {
        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->where('id', '!=', $category->id) // exclude itself to prevent selecting self as parent
            ->get();

        return view('admin.pages.categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'parent_id' => 'nullable|exists:categories,id|not_in:' . $category->id,
        ], [
            'name.unique' => "The category '{$request->name}' has already been added.",
            'name.required' => "The category '{$request->name}' has already been added.",
        ]);

        $category->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('categories.index')->with('success', "Category '{$category->name}' updated successfully!");
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', "Category '{$category->name}' deleted successfully!");
    }
}
