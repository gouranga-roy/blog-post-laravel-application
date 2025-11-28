<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Display a listing of the blogs.
    public function index() {
        $allBlogs = Blog::with(['category', 'author'])->orderBy('created_at', 'desc')->get();
        return view('blog.index', compact('allBlogs'));
    }

    // Show the form for creating a new blog.
    public function create() {
        // Get categories for the dropdown
        $categories = Category::all();
        return view('blog.create', compact('categories'));
    }

    // Store Blog
    public function store(Request $request) {
        // Validation
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validated['author_id'] = auth('admin')->id();

        // File upload
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('thumbnails'), $filename);
            $validated['thumbnail'] = '/public/thumbnails/' . $filename;
        }

        // // Create the blog post
        Blog::create($validated);

        // // Redirect or return response
        return redirect()->route('blog.index')->with('success', 'Blog post created successfully.');
    }
}
