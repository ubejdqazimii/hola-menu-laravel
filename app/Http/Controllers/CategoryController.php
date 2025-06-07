<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    // Ensure only authenticated users can access
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    // Show all categories
    public function index()
    {
        $categories = Category::orderBy('order')->paginate(10);

        return view('categories.index', compact('categories'));
    }

    // Show the form to create a new category
    public function create()
    {
        return view('categories.create');
    }

    // Store the new category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'nullable|integer',
        ]);

        Category::create($request->only('name', 'order'));

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    // Show the form to edit a category
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Update the category
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'nullable|integer',
        ]);

        $category->update($request->only('name', 'order'));

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    // Delete the category
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}

