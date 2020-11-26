@extends('layouts.admin')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Kegiatan</h1>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error}}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $item->id }}</td>
                </tr>
                <tr>
                    <th>Judul</th>
                    <td>{{ $item->title }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $item->description }}</td>
                </tr>
                <tr>
                    <th>Tag</th>
                    <td>{{ $item->activity_tag->tag }}</td>
                </tr>
                <tr>
                    <th>tgl buat</th>
                    <td>{{ \Carbon\Carbon::parse($item->time)->format('d, M-Y') }}</td>
                </tr>
                <tr>
                    <th>Foto</th>
                    <td>@foreach($item->activity_gallery as $g)
                        <img src="{{ Storage::url($g->image) }}" alt="" style="width: 250px" class="img-thumbnail"> @endforeach</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection