@extends('layouts.admin')

@section('content')

<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-3 mt-2">
            <h1 class="h3 mb-0 text-gray-800">Kategori Blog</h1>
            <a href="{{ route('blog-categories.create') }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Kategori
            </a>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <table id="datatable" class="table table-bordered dt-responsive" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori Blog</th>
                                <th>Deskripsi Singkat</th>
                                <th>Image</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            ?>
                            @foreach($items as $items)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $items->categories }}</td>
                                <td>{{ $items->description }}</td>
                                <td>
                                    <img src="{{ Storage::url($items->image) }}" alt="" style="width: 150px" class="img-thumbnail">
                                </td>

                                <td>
                                    <a href="{{ route('blog-categories.edit', $items->id) }}" class="btn btn-info">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('blog-categories.destroy', $items->id) }}" method="POST" class="d-inline" onclick="return confirm('Yakin ingin menghapus? jika hapus di Kategori ini maka Kegiatan yg memiliki kategori ini juga akan terhapus');">
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
    </div> <!-- container -->
</div> <!-- content -->

@endsection