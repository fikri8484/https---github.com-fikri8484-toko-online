<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'blogs_id', 'name', 'email', 'comment'
    ];

    protected $hidden = [];

    public function blog_comment()
    {
        return $this->belongsTo(Blog::class, 'blogs_id', 'id');
    }
}
