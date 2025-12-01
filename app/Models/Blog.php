<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'category_id', 'author_id', 'thumbnail'];

    // Relation with category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relaton with User
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Relation with comment
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id')->with('replies');
    }
}
