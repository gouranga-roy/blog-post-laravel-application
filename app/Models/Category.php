<?php

namespace App\Models;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Mass assignable attributes
    protected $fillable = ['name', 'slug', 'description'];

    // Relationship
    public function posts() {
        return $this->hasMany(Blog::class);
    }
}
