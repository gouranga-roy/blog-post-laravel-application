<?php

namespace App\Models;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // Comments value
    protected $fillable = ['blog_id', 'comment', 'user_name', 'user_email', 'parent_id', 'status'];

    // Relation with comment
    public function blogs()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }

    // Parent Comment
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Relation comment with reply
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->with('replies');
    }

}
