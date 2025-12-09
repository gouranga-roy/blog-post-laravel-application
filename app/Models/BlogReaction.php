<?php

namespace App\Models;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class BlogReaction extends Model
{

    protected $fillable = ['user_id', 'blog_id', 'type'];

    // Relations with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relations with blog
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
