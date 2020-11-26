@extends('layouts.admin')

@section('content')

<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mt-2">
            <h1 class="h3 mb-0 text-gray-800">Blog</h1>
            <a href="{{ route('blog.create') }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Blog
            </a>
        </div>
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            .
            <a href="{{ route('blog-categories.index') }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-cog fa-sm text-white-50"></i> Kategori
            </a>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="max-width: 10px;">No</th>
                                        <th style="max-width: 70px;">Judul</th>
                                        <th>Kategori</th>
                                        <th>Penulis</th>
                                        <th style="max-width: 70px;">tgl Pembuatan</th>
                                        <th>Foto</th>
                                        <th style="max-width: 250px;">Deskripsi</th>
                                        <th style="max-width: 150px;">Aksi</th>
                                    </tr>
                                </thead>




                                <tbody>
                                    <?php $i = 1;
                                    ?>
                                    @foreach($blog as $a)

                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $a->title }}</td>
                                        <td>{{ $a->blog_category->categories }}</td>
                                        <td>{{ $a->author }}</td>
                                        <td>{{ $a->created_at }}</td>
                                        <td>
                                            <img src="{{ Storage::url($a->image) }}" alt="" style="width: 150px" class="img-thumbnail">
                                        </td>
                                        <td>{!! \Illuminate\Support\Str::limit($a->description, $limit = 10) !!}</td>
                                        <td>
                                            <a href="{{ route('blog.show', $a->id) }}" class="btn btn-info">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('blog.edit', $a->id) }}" class="btn btn-info">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{ route('blog.destroy', $a->id) }}" method="POST" class="d-inline" onclick="return confirm('Yakin ingin menghapus?');">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>

                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div> <!-- container -->

</div> <!-- content -->

@endsection