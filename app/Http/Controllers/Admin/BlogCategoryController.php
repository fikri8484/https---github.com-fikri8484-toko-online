<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\Blog;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;


class BlogCategoryController extends Controller
{
    public function index()
    {
        $items = BlogCategory::orderBy('id', 'DESC')->get();

        return view('pages.admin.blog-categories.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.blog-categories.create');
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
            'categories' => 'required|max:255',
            'image' => 'required|image',
            'description' => 'required'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->categories);
        $data['image'] = $request->file('image')->store(
            'assets/blog-categories',
            'public'
        );

        BlogCategory::create($data);
        Alert::success('Sukses', 'Selamat Data Berhasil Di Input');
        return redirect()->route('blog.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = BlogCategory::findOrFail($id);

        return view('pages.admin.blog-categories.edit', [
            'item' => $item
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
                'categories' => 'required|max:255',
                'image' => 'required|image',
                'description' => 'required'
            ]);
            $data = $request->all();
            $data['slug'] = Str::slug($request->categories);
            $data['image'] = $request->file('image')->store(
                'assets/blog-categories',
                'public'
            );
        } else {
            request()->validate([
                'categories' => 'required|max:255',
                'description' => 'required'
            ]);
            $data = $request->all();
            $data['slug'] = Str::slug($request->categories);
        }

        $item = BlogCategory::findOrFail($id);
        $item->update($data);
        Alert::success('Sukses', 'Selamat Data Berhasil Diubah');
        return redirect()->route('blog-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = BlogCategory::findOrFail($id);
        $item->delete();

        $data = Blog::where('blog_categories_id', $id);
        $data->delete();

        return redirect()->route('blog-categories.index');
    }
}
