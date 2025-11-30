<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    // Display a listing of the blogs.
    public function index()
    {
        // Login Check
        $loginUser = Auth::guard('admin')->user()->id;

        $allBlogs = Blog::with(['category', 'author'])->where('author_id', $loginUser)->get();
        return view('blog.index', compact('allBlogs'));
    }

    // Show the form for creating a new blog.
    public function create()
    {
        // Get categories for the dropdown
        $categories = Category::all();
        // $categories = Category::get();
        return view('blog.create', compact('categories'));
    }

    // Store Blog
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'thumbnail'   => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $validated['author_id'] = auth('admin')->id();

        // File upload
        if ($request->hasFile('thumbnail')) {
            $file     = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('thumbnails'), $filename);
            $validated['thumbnail'] = 'thumbnails/' . $filename;
        }

        // // Create the blog post
        Blog::create($validated);

        // // Redirect or return response
        return redirect()->route('blog.index')->with('success', 'Blog post created successfully.');
    }

    // Display single blog
    public function show($slug)
    {
        $blog = Blog::with(['category', 'author'])->where('slug', $slug)->firstOrFail();
        return view('blog.view', compact('blog'));
    }

    // Edit Blog
    public function edit($slug)
    {
        $blog       = Blog::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        return view('blog.edit', compact('blog', 'categories'));
    }

    // Update Blog
    public function update(Request $request, $slug)
    {
        // Validation
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'thumbnail'   => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $validated['author_id'] = auth('admin')->id();

        // Edit file upload unlink previous file

        if ($request->hasFile('thumbnail')) {
            // Unlink previous file
            $blog = Blog::where('slug', $slug)->firstOrFail();

            $path = str_replace('/public', '', $blog->thumbnail);
            $path = public_path($path);

            if ($blog->thumbnail && file_exists($path)) {
                unlink($path);
            }

            $file = $request->file('thumbnail');

            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('thumbnails'), $filename);
            $validated['thumbnail'] = '/public/thumbnails/' . $filename;
        }

        // Create the blog post
        Blog::where('slug', $slug)->update($validated);

        // Redirect or return response
        return redirect()->route('blog.index')->with('success', 'Blog post Updated successfully.');
    }

    // Delete Blog
    public function destroy($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();

        // Unlink thumbnail file
        $thumbnailPath = public_path($blog->thumbnail);
        if ($blog->thumbnail && file_exists($thumbnailPath)) {
            unlink($thumbnailPath);
        }

        // Delete blog
        $blog->delete();

        return redirect()->route('blog.index')->with('success', 'Blog post deleted successfully.');
    }
}
