<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;


class BlogController extends Controller
{
    public function index()
    {
        $blog = Blog::orderBy('id', 'DESC')->get();
        return view('pages.admin.blog.index', ['blog' => $blog]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blog_categories = BlogCategory::all();
        return view('pages.admin.blog.create', [
            'blog_categories' => $blog_categories
        ]);
    }

    /**
     * Store a newly created resource in storage. store utk nyimpan data
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'blog_categories_id' => 'required|integer|exists:blog_categories,id',
            'title' => 'required|max:255',
            'image' => 'required|image',
            'author' => 'required',
            'description' => 'required'
        ]);
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['image'] = $request->file('image')->store(
            'assets/blog',
            'public'
        );

        Blog::create($data);
        Alert::success('Sukses', 'Selamat Data Berhasil Di Input');

        return redirect()->route('blog.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Blog::find($id);
        return view('pages.admin.blog.show', ['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Blog::findOrFail($id);
        $categories = BlogCategory::all();
        return view('pages.admin.blog.edit', [
            'item' => $item,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $image  = $request->file('image');
        if ($image != '') {
            request()->validate([
                'blog_categories_id' => 'required|integer|exists:blog_categories,id',
                'title' => 'required|max:255',
                'image' => 'required|image',
                'author' => 'required',
                'description' => 'required'
            ]);
            $data = $request->all();
            $data['slug'] = Str::slug($request->title);
            $data['image'] = $request->file('image')->store(
                'assets/blog',
                'public'
            );
        } else {
            request()->validate([
                'blog_categories_id' => 'required|integer|exists:blog_categories,id',
                'title' => 'required|max:255',
                'author' => 'required',
                'description' => 'required'
            ]);
            $data = $request->all();
            $data['slug'] = Str::slug($request->title);
        }

        $item = Blog::findOrFail($id);
        $item->update($data);
        Alert::success('Sukses', 'Selamat Data Berhasil Diubah');
        return redirect()->route('blog.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Blog::findOrFail($id);
        $item->delete();
        return redirect()->route('blog.index');
    }
}
