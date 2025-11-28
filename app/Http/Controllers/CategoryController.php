<?php

namespace App\Http\Controllers;

use Str;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // View Category
    public function index() {
        // Get all categories
        $categories = Category::orderByDesc("id")->get();
        return view("category.index", compact('categories'));
    }

    // Create Category
    public function create() {
        return view("category.create");
    }

    // Category Store
    public function store(Request $request) {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|unique:categories|max:255',
            'description' => 'nullable|string',
        ]);

        //  Store the category in database
        Category::create([
            'name'=> $validated['name'],
            'slug'=> Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
        ]);

        // Redirect to the category home
        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    // Edit Category
    public function edit($slug) {
        // Find the category by ID
        $category = Category::where('slug', $slug)->firstOrFail();
        return view("category.edit", compact('category'));
    }

    // Update Category
    public function update(Request $request, $slug) {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|unique:categories,name,'.$slug.'|max:255',
            'description' => 'nullable|string',
        ]);

        // Find the category by ID
        $category = Category::where('slug', $slug)->firstOrFail();

        // Update the category in database
        $category->update([
            'name'=> $validated['name'],
            'slug'=> Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
        ]);

        // Redirect to the category home
        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    // Delete Category
    public function destroy($id) {
        // Find the category by ID
        $category = Category::findOrFail($id);

        // Delete the category
        $category->delete();

        // Redirect to the category home
        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');  

    }


}
