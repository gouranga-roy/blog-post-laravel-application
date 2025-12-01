<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Submit Comment
    public function store(Request $request)
    {
        // Check Validatoin
        $validated = $request->validate([
            'user_name'  => "required|string|max:255",
            'user_email' => "required|string|email|max:255",
            'comment'    => "required|string|max:255",
            'blog_id'    => "required",
        ]);

        // Store data in comment table
        Comment::create($validated);

        // If success the comment
        return back()->with('success', 'Comment Send Successfully!');
    }

    // Comment Reply
    public function commentReply(Request $request)
    {
        // Validated comment reply
        $validated = $request->validate([
            'user_name'  => "required|string|max:255",
            'user_email' => "required|string|email",
            'comment'    => "required|string|max:255",
            'blog_id'    => "required|string",
            'parent_id'  => "required|string",
        ]);

        // Store comment reply
        Comment::create($validated);

        // Return success
        return back()->with('success', 'Comment reply successfully!');
    }
}
