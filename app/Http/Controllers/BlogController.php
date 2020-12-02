<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Models\Blog;
use App\Models\BlogCategory;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $category = BlogCategory::all();
        $blog = Blog::orderBy('id', 'DESC')->paginate(2);
        return view('pages.blog', compact('category', 'blog'));
    }
}
