<?php

namespace App\Http\Controllers;

use App\Models\BlogReaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogReactionController extends Controller
{
    public function reaction(Request $request)
    {
        // return dd($request);
        $request->validate([
            'blog_id' => 'required|exists:blogs,id',
            'type'    => 'required|in:like,dislike',
        ]);

        if (! Auth::guard('admin')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $userId = Auth::guard('admin')->user()->id;

        $reaction = BlogReaction::where('user_id', $userId)
            ->where('blog_id', $request->blog_id)
            ->first();

        if ($reaction) {
            if ($reaction->type === $request->type) {
                $reaction->delete();

                return response()->json([
                    'status'        => 'removed',
                    'like_count'    => BlogReaction::where('blog_id', $request->blog_id)->where('type', 'like')->count(),
                    'dislike_count' => BlogReaction::where('blog_id', $request->blog_id)->where('type', 'dislike')->count(),
                ]);
            }

            $reaction->update([
                'type' => $request->type,
            ]);
        } else {
            BlogReaction::create([
                'user_id' => $userId,
                'blog_id' => $request->blog_id,
                'type'    => $request->type,
            ]);
        }

        return response()->json([
            'status'        => 'success',
            'like_count'    => BlogReaction::where('blog_id', $request->blog_id)->where('type', 'like')->count(),
            'dislike_count' => BlogReaction::where('blog_id', $request->blog_id)->where('type', 'dislike')->count(),

            'has_like'      => BlogReaction::where('blog_id', $request->blog_id)->where('user_id', $userId)->where('type', 'like')->exists(),
            'has_dislike'   => BlogReaction::where('blog_id', $request->blog_id)->where('user_id', $userId)->where('type', 'dislike')->exists(),
        ]);
    }

}
