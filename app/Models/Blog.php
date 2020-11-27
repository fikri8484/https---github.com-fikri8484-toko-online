<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'blog_categories_id', 'title', 'slug', 'author', 'image', 'description'
    ];

    protected $hidden = [];

    public function blog_category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_categories_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'blogs_id', 'id');
    }
}
