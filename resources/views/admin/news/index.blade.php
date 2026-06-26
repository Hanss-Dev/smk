@extends('layouts.admin')

@section('title', 'Kelola Berita')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Berita</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Berita</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">

      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
          {{ session('success') }}
          <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
      @endif

      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h3 class="card-title">Daftar Berita</h3>
          <a href="{{ route('admin.news.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Berita
          </a>
        </div>

        <div class="card-body table-responsive">
          <table class="table table-bordered table-hover">
            <thead class="bg-light">
              <tr>
                <th width="50">No</th>
                <th>Thumbnail</th>
                <th>Judul</th>
                <th>Slug</th>
                <th width="100">Status</th>
                <th width="120">Tanggal</th>
                <th width="120">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($newsList as $i => $n)
                <tr>
                  <td class="text-center">{{ $i + 1 }}</td>
                  <td>
                    @if($n->thumbnail)
                      <img src="{{ asset('uploads/news/' . $n->thumbnail) }}" style="height:40px; object-fit:cover; border-radius:4px;">
                    @else
                      <span class="text-muted">-</span>
                    @endif
                  </td>
                  <td>{{ Str::limit($n->title, 60) }}</td>
                  <td><small class="text-muted">{{ $n->slug }}</small></td>
                  <td class="text-center">
                    <span class="badge badge-{{ $n->status === 'publish' ? 'success' : 'warning' }}">
                      {{ ucfirst($n->status) }}
                    </span>
                  </td>
                  <td class="text-center">{{ $n->created_at ? $n->created_at->format('d M Y') : '-' }}</td>
                  <td class="text-center">
                    <a href="{{ route('admin.news.edit', $n->id) }}" class="btn btn-warning btn-sm" title="Edit">
                      <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.news.destroy', $n->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus berita ini?')">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr><td colspan="7" class="text-center text-muted">Belum ada berita.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </section>
</div>
@endsection
