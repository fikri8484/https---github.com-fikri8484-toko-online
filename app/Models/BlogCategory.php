<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'categories', 'slug', 'image', 'description'
    ];

    protected $hidden = [];

    public function blogs()
    {
        return $this->hasMany(Activity::class, 'blog_categories_id', 'id');
    }
}
