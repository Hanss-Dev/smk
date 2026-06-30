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
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
          <h3 class="card-title my-1">Daftar Berita</h3>
          <div class="d-flex align-items-center flex-wrap" style="gap: 10px;">
            <form action="{{ route('admin.news.index') }}" method="GET" class="form-inline my-1">
              <div class="input-group input-group-sm" style="width: 250px;">
                <input type="text" name="search" class="form-control float-right" placeholder="Cari berita..." value="{{ request('search') }}">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                  @if(request('search'))
                    <a href="{{ route('admin.news.index') }}" class="btn btn-default" title="Reset Pencarian">
                      <i class="fas fa-times"></i>
                    </a>
                  @endif
                </div>
              </div>
            </form>
            <a href="{{ route('admin.news.create') }}" class="btn btn-primary btn-sm my-1">
              <i class="fas fa-plus"></i> Tambah Berita
            </a>
          </div>
        </div>

        <div class="card-body table-responsive">
          @include('admin.components.pagination-controls')
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
                  <td class="text-center">{{ ($newsList->currentPage() - 1) * $newsList->perPage() + $i + 1 }}</td>
                  <td>
                    @if($n->thumbnail)
                      <img class="preview-image" src="{{ asset('uploads/news/' . $n->thumbnail) }}" style="height:40px; object-fit:cover; border-radius:4px;">
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
                    <form action="{{ route('admin.news.destroy', $n->id) }}" method="POST" style="display:inline;" class="form-delete" data-confirm-message="Hapus berita ini?">
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
        <div class="card-footer clearfix">
          <div class="float-right">
            {{ $newsList->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
          </div>
        </div>
      </div>

    </div>
  </section>
</div>
@endsection
